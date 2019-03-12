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
use App\ProviderMember;
use App\ProviderRegion;

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
                        $user->role_id = 2;
                        $user->save();
                    });


        $providers->each(function($provider){
                $providerMembers = new  ProviderMember();
                $providerMembers->provider_id = $provider->id;
                $providerMembers->tecnics = rand(0,4);
                $providerMembers->professionals = rand(0,4);
                $providerMembers->masters = rand(0,4);
                $providerMembers->doctors = rand(0,4);
                $providerMembers->save();

                $cases = factory(Instance::class, rand(1,6))->make();
                $provider->cases()->saveMany($cases);
                $services = Service::inRandomOrder()->get();
                for ($i=0; $i < rand(3,6); $i++) {
                    $randa = rand(1,18);
                    $provider_region = new ProviderRegion();
                    $provider_region->provider_id = $provider->id;
                    $provider_region->city_id = $randa;
                    $provider_region->save();
                    $randa = rand(1,58);
                    $provider_service = new ProviderService();
                    $provider_service->service_id = $services[$randa]->id;
                    $provider_service->provider_id = $provider->id;
                    $provider_service->save();
                    $servicios[$i] = $provider_service->service_id;
                }

                $cases->each(function($case) use ($servicios){
                        if(rand(0,0)){
                            $images = factory(InstanceImage::class, 1)->make();
                            $case->images()->saveMany($images);
                            $images[0]->featured = true;
                            $images[0]->save();      
                        }

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
