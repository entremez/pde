Vue.config.devtools = true

new Vue({
  el: "#button_login",
  data: {
    modal: false,
    submit: false,
    mail: null,
    password: null,
    errors: {}
  },
  methods: {
    checkForm: function () {
      this.errors = {};
      if(!this.mail) this.errors['mail']  = "Este campo es obligatorio";
      if(!this.password) this.errors['password']  = "Este campo es obligatorio";
      if(Object.keys(this.errors).length == 0){
        return true;
      } 
      e.preventDefault();
    }
  },
  computed:{
    hasErrors: function () {
      return this.errors;
    }
  }
});

new Vue({
  el: "#button_singup",
  data: {
    modal: false,
    submit: false,
    mail: null,
    password: null,
    password_confirmed: null,
    errors: {}
  },
  methods: {
    checkForm: function (e) {
      this.errors = {};
      if(!this.mail) this.errors['mail']  = "Este campo es obligatorio";
      if(!this.password) this.errors['password']  = "Este campo es obligatorio";
      if(!this.password_confirmed) this.errors['password_confirmed']  = "Este campo es obligatorio";
      if(this.password != this.password_confirmed) this.errors['password_confirmed']  = "Las contraseñas deben ser iguales";
      
      if(Object.keys(this.errors).length == 0){
        return true;
      } 
      e.preventDefault();
    }
  },
  computed:{
    hasErrors: function () {
      return this.errors;
    }
  }
});

new Vue({
  el: "#config_form",
  data: {
    region: null,
    region_selected: false,
    comunas: null,
    full_name: null,
    ocupation: null,
    rut: null,
    type: null,
    company_name: null,
    company_rut: null,
    company_size: null,
    comuna_id: null,
    city: null,
    address: null,
    phone: null,
    mobile_phone: null,
    notification_email: null,
    web: null,
    terms: null,
    errors: {}
  },
  methods: {
    getComunas: function (e) {
      this.comunas = null;
      axios
      .get('/api/comunas/'+this.region)
      .then(response =>(this.comunas = response.data));
      this.region_selected = true;
    },
    checkForm: function (e) {
      this.errors = {};

      if(!this.region ) this.errors['region'] = "Debe seleccionar una región";
      if(!this.full_name ) this.errors['full_name'] = "Este campo es obligatorio";
      if(!this.ocupation ) this.errors['ocupation'] = "Este campo es obligatorio";
      if(!this.rut ) this.errors['rut'] = "Este campo es obligatorio";
      if(!this.type ) this.errors['type'] = "Este campo es obligatorio";
      if(!this.company_name ) this.errors['company_name'] = "Este campo es obligatorio";
      if(!this.company_rut ) this.errors['company_rut'] = "Este campo es obligatorio";
      if(!this.company_size ) this.errors['company_size'] = "Este campo es obligatorio";
      if(!this.comuna_id ) this.errors['comuna_id'] = "Debe seleccionar una comuna";
      if(!this.city ) this.errors['city'] = "Este campo es obligatorio";
      if(!this.address ) this.errors['address'] = "Este campo es obligatorio";
      if(!this.mobile_phone ) this.errors['mobile_phone'] = "Este campo es obligatorio";
      if(!this.notification_email ) this.errors['notification_email'] = "Este campo es obligatorio";
      if(!this.terms ) this.errors['terms'] = "Se deben aceptar los términos y condiciones";
      
      if(Object.keys(this.errors).length == 0){
        return true;
      } 
      e.preventDefault();
    }
  },
  computed:{
    hasErrors: function () {
      this.errors = {};

      if(!this.region ) this.errors['region'] = "Debe seleccionar una región";
      if(!this.full_name ) this.errors['full_name'] = "Este campo es obligatorio";
      if(!this.ocupation ) this.errors['ocupation'] = "Este campo es obligatorio";
      if(!this.rut ) this.errors['rut'] = "Este campo es obligatorio";
      if(!this.type ) this.errors['type'] = "Este campo es obligatorio";
      if(!this.company_name ) this.errors['company_name'] = "Este campo es obligatorio";
      if(!this.company_rut ) this.errors['company_rut'] = "Este campo es obligatorio";
      if(!this.company_size ) this.errors['company_size'] = "Este campo es obligatorio";
      if(!this.comuna_id ) this.errors['comuna_id'] = "Debe seleccionar una comuna";
      if(!this.city ) this.errors['city'] = "Este campo es obligatorio";
      if(!this.address ) this.errors['address'] = "Este campo es obligatorio";
      if(!this.mobile_phone ) this.errors['mobile_phone'] = "Este campo es obligatorio";
      if(!this.notification_email ) this.errors['notification_email'] = "Este campo es obligatorio";
      if(!this.terms ) this.errors['terms'] = "Se deben aceptar los términos y condiciones";
      return this.errors;
    }
  }
});

new Vue({
  el: "#company",
  data: {
    justSave: false,
    company: null,
    res_sanitaria: null,
    checked_actv: [],
    checked_region: [],
    errors: {},
    company_db: null,
    evaluation: null
  },
  methods: {
    save: function (e) {
      this.justSave = true;
      return true;
    },
    submit: function (e) {
      this.justSave = false;
      this.errors = {};
      if(this.res_sanitaria == null ) this.errors['res_sanitaria'] = "Este campo es obligatorio";
      if(this.company == null) this.errors['company'] = "Este campo es obligatorio";

      if(this.checked_actv.length == 0) this.errors['checked_actv'] = "Debe seleccionar al menos una actividad";
      if(this.checked_region.length == 0) this.errors['checked_region'] = "Debe seleccionar al menos una región";

      if(Object.keys(this.errors).length == 0){
        return true;
      }
      this.$refs.focus_1.focus();
      e.preventDefault();
    }
  },  
  computed:{
    hasErrors: function () {
      return this.errors;
    }
  },
  mounted: function () {
    if(this.$el.querySelector("#company") != null){	
      this.company_db = JSON.parse(this.$el.querySelector("#company").value);
      if(this.company_db.sanitary_resolution != null) this.res_sanitaria = this.company_db.sanitary_resolution;
      if(this.company_db.startup_statement != null) this.company = this.company_db.startup_statement;
    }
    if(this.$el.querySelector("#evaluation") != null){	
      this.evaluation = JSON.parse(this.$el.querySelector("#evaluation").value);
      this.checked_actv = this.evaluation.activities;
      this.evaluation.activities.forEach(function(actv){
        document.getElementById("activity-"+actv.activity_id).checked = true;
      });
      this.checked_region = this.evaluation.cities;
      this.evaluation.cities.forEach(function(actv){
        document.getElementById("region-"+actv.region_id).checked = true;
      });
    }
  }
});

new Vue({
  el: "#evaluation_design_form",
  data: {
    responses: null,
    order: null,   
    justSave: false,
    isPdeFullyAnswered: false,
    user_id: null,
  },
  methods: {
    move: function (arr, old_index, new_index) {
      array_move(arr, old_index, new_index);
    },
    save: function (e) {
      this.justSave = true;
      return true;
    },
    submit: function (e) {
      this.justSave = false;
      return true;
    }
  },
  mounted(){
    if(this.$el.querySelector("#order") != null){	
      this.order = JSON.parse(this.$el.querySelector("#order").value);
    }
    if(this.$el.querySelector(".responses") != null){
    this.responses = JSON.parse(this.$el.querySelector(".responses").value);
      this.responses.forEach(function(response, index){
        if(index == 0){
          for(var i = 3; i < 11; i++){
            if(response.response[i]){
              document.getElementById(i).checked = true;
            }
          }
        }
        if(index == 1){
          if(response != null){
            document.getElementById(response.response).checked = true;
          }
        }
        if(index == 2){
          for(var i = 16; i <= 20; i++){
            if(response.response[i] != 0){
              document.getElementById(i+"-"+response.response[i]).checked = true;
            }
            
          }
        }
        if(index == 3){
          for(var i = 21; i <= 23; i++){
            if(response.response[i] != 0){
              document.getElementById(i+"-"+response.response[i]).checked = true;
            }
            
          }
        }
        if(index == 4){
          for(var i = 24; i <= 28; i++){
            if(response.response[i] != 0){
              document.getElementById(i+"-"+response.response[i]).checked = true;
            }
            
          }
        }
        if(index == 5){
          for(var i = 29; i <= 33; i++){
            if(response.response[i] != 0){
              document.getElementById(i+"-"+response.response[i]).checked = true;
            }
            
          }
        }
        if(index == 6){
          
        }
      });
    }
  },
  computed:{
    getOrder: function () {
      return JSON.stringify(this.order);
    }
  }
});

function array_move(arr, old_index, new_index) {
  if (new_index >= arr.length) {
      var k = new_index - arr.length + 1;
      while (k--) {
          arr.push(undefined);
      }
  }
  arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
  return arr; // for testing
};

const menuButton = document.getElementById("js-menu-button");
const menu = document.getElementById("js-menu");
const body = document.body;

/* OPEN-CLOSE MOBILE MENU */
const controlMobileMenu = () => menu.classList.toggle("is-visible");

/* ADD CLASS ACTIVE TO LINK CLICKED */
const controlDesktopMenu = (linkclick) => {
    menu.querySelectorAll("a").forEach((link) => link.classList.remove("is-active"));
    linkclick.classList.add("is-active");
};

/* NAVIGATION MOBILE */
const BREAKPOINT_MENU = 700; //Same value of media query change from mobile to desktop menu
const navigation = (e) => {
    if (!e.target.matches("a")) return;
    window.innerWidth <= BREAKPOINT_MENU ? controlMobileMenu() : controlDesktopMenu(e.target);
};

/* NAVIGATION MOBILE */
menu.addEventListener("click", navigation);

/************ EVENTS *************/

/* OPEN-CLOSE MOBILE MENU */
menuButton.addEventListener("click", controlMobileMenu);