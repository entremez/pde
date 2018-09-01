<?php

use Illuminate\Database\Seeder;
use App\Provider;
use App\User;
use App\InstanceImage;
use App\Instance;
use App\InstanceService;
use App\Service;
use App\ProviderService;
use App\Category;
use Illuminate\Support\Collection as Collection;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$providers = factory(Provider::class, 10)->create();
        $users = factory(User::class, 10)->create();
        $providers = new Collection();
        $users->each(function($user) use ($providers){
                        $provider = factory(Provider::class)->create();
                        $provider->user_id = $user->id;
                        $provider->save();
                        $providers->push($provider);
                        $user->type_id = $provider->id;
                        $user->type = "Provider";
                        $user->save();
                    });


        $providers->each(function($provider){
                $cases = factory(Instance::class, 3)->make();
                $provider->cases()->saveMany($cases);
                $services = Service::inRandomOrder()->get();
                for ($i=0; $i < rand(3,6); $i++) {
                    $randa = rand(0,45);
                    $provider_service = new ProviderService();
                    $provider_service->service_id = $services[$randa]->id;
                    $provider_service->provider_id = $provider->id;
                    $provider_service->save();
                    $servicios[$i] = $provider_service->service_id;
                }

                $cases->each(function($case) use ($servicios){
                        $images = factory(InstanceImage::class, 3)->make();
                        $case->images()->saveMany($images);
                        $images[0]->featured = true;
                        $images[0]->save();
                        for ($i=0; $i < rand(1,3); $i++) {
                            $instance_service = new InstanceService();
                            $instance_service->instance_id = $case->id;
                            $instance_service->service_id = $servicios[$i];
                            $instance_service->save();
                        }
                    });
        });
    }
}
