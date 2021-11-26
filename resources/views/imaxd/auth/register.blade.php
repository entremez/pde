<transition name="fade">
    <div class="modal-overlay" v-if="modal" v-cloak>
      <div class="modal">
        <span @click="modal = false">&times;</span>
        <div class="modal__header">
          <h3>Registrarse IMAxD</h3>
        </div>
        <div class="modal-body">
            <form class="form" method="POST" action="{{ route('register') }}" @submit="checkForm">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email-register">Correo electrónico</label>
                    <input type="email" name="email-register" v-model="mail">
                    <p class="errors" v-if="hasErrors['mail']">@{{ hasErrors['mail'] }}</p>
                </div>
                <div class="form-group">
                    <label for="password-register">Contraseña</label>
                    <input type="password" name="password-register" v-model="password">
                    <p class="errors" v-if="hasErrors['password']">@{{ hasErrors['password'] }}</p>
                </div>                
                <div class="form-group">
                    <label for="password_confirmed">Confirmar contraseña</label>
                    <input type="password" name="password_confirmed" v-model="password_confirmed">
                    <p class="errors" v-if="hasErrors['password_confirmed']">@{{ hasErrors['password_confirmed'] }}</p>
                </div>
                <div class="form-group">  
                    <button type="submit">Entrar</button>
                </div>
                <a>¿Olvidaste tu contraseña?</a>
                <input type="hidden" name="imaxd" value="imaxd">
            </form>

        </div>
      </div>
    </div>
  </transition>


