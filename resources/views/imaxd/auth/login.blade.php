<transition name="fade">
    <div class="modal-overlay" v-if="modal" v-cloak>
      <div class="modal">
        <span @click="modal = false">&times;</span>
        <div class="modal__header">
          <h3>Iniciar sesión IMAxD</h3>
        </div>
        <div class="modal-body">
            <form class="form" method="POST" action="{{ route('login') }}" @submit="checkForm">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" v-model="mail">
                    <p class="errors" v-if="hasErrors['mail']">@{{ hasErrors['mail'] }}</p>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" v-model="password">
                    <p class="errors" v-if="hasErrors['password']">@{{ hasErrors['password'] }}</p>
                </div>
                <label class="checkbox">Recordar
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <div class="form-group">  
                    <button type="submit">Entrar</button>
                </div>
                <a>¿Olvidaste tu contraseña?</a>
            </form>

        </div>
      </div>
    </div>
  </transition>




