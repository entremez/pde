    <div class="row mt-5">
    	<div class="col">
    		<h4>Usuarios que no han completado su perfil (<span id="number_users">{{ $usersWithoutProfile->count() }}</span>) <span id="users_without_profile"><i class="fas fa-sort-down"></i></span><span id="users_without_profile_up" style="display: none"><i class="fas fa-sort-up"></i></span></h4>
    		<table class="table" id="users_without_profile_table" style="display: none">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Mail</th>
			      <th scope="col">Tipo usuario</th>
			      <th scope="col">Fecha creación</th>
			      <th scope="col">Envío de correo</th>
			      <th scope="col">Contacto</th>
			    </tr>
			  </thead>
			  <tbody id="users-no-profile">
			  	@foreach( $usersWithoutProfile as $user)
				    <tr >
				      <th scope="row">{{ $user->id}}</th>
				      <td>{{ $user->email}}</td>
				      <td>{{ $user->type()}}</td>
				      <td>{{ date('d-m-Y', strtotime($user->created_at))}}</td>
				      <td>
				      	@if(date('d-m-Y H:i', strtotime($user->updated_at)) == date('d-m-Y H:i', strtotime($user->created_at)))
							<span id="users-no-profile-{{ $user->id }}"></span>
				      	@else
							<span id="users-no-profile-{{ $user->id }}">{{ date('d-m-Y', strtotime($user->updated_at))}}</span>
				      	@endif</td>
				      <td><button class="btn btn-danger" id="userWithoutProfile" data-id = "{{ $user->id }}" data-url = "{{ route('user.without.profile') }}" data-token = "{{ csrf_token() }}">Enviar recordatorio</button></td>
				    </tr>
			    @endforeach
			  </tbody>
			</table>
    	</div>
    </div>