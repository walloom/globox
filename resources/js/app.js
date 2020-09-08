/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//   el: '#app',
// });


Vue.component('message', require('./components/Message.vue').default);
Vue.component('sent-message', require('./components/Sent.vue').default);

const app = new Vue({
  el: '#app',
  data: {
    messages: []
  },
  mounted(){
    this.fetchMessages();
    Echo.private('chat')
      .listen('MessageSentEvent', (e) => {
      this.messages.push({
        message: e.message.message,
        user: e.user
      })
    })
  },
  methods: {
    addMessage(message) {
      this.messages.push(message)
      axios.post('/messages', message).then(response => {
        console.log(response)
      })
    },
    fetchMessages() {
      axios.get('/messages').then(response => {
        this.messages = response.data
      })
    }
  }
});



$(document).ready(function(evt){
  $("#stateSelect").on("change", function(evt){
    $state = $(this).val();
    make.getCities($state);
  });

});

make.getCities = function( $state ){
  $path = $("#pathCities").val();
  // $path = $path.replace("http://", "https://");
  let data = {
    state: $state
  }

  axios.post($path, data).then(res =>{
    if (res.data.result){
      make.displayCities( res.data.ciudades );
    }
  }, err=>{
    console.log(err);
  })
}

make.getDeparments = function (){
  $path = $("#pathDepartment").val();
  // $path = $path.replace("http://", "https://");

  let data = {}
  axios.post($path, data).then(res =>{
    if (res.data.result){
      // displayCitiesWithSelect( res.data.ciudades, $city );
    }
  }, err=>{
    console.log(err);
  })
}

make.displayCities = function( $ciudades ){
  let cadHtml = '<option selected value="">- Seleccionar -</option>';
  $ciudades.forEach(city => {
    cadHtml += `<option val="${ city.ciudad }">${ city.ciudad }</option>`;
  });

  $("#citySelect").html(cadHtml);
}

make.preloadCity = function ( $state, $city ){
  $path = $("#pathCities").val();
  // $path = $path.replace("http://", "https://");
  let data = {
    state: $state
  }
  axios.post($path, data).then(res =>{
    if (res.data.result){
      make.displayCitiesWithSelect( res.data.ciudades, $city );
    }
  }, err=>{
    console.log(err);
  })
}

make.saveSetting = function ( settings ){
  $path = $("#pathSettings").val();
  // $path = $path.replace("http://", "https://");
  
  axios.post($path, settings).then(res =>{
    if (res.data.result){
      window.location.reload();
    }
  }, err=>{
    console.log(err);
  })
}

make.displayCitiesWithSelect = function( $ciudades, $citySelected ){
  let cadHtml = '<option value="">- Seleccionar -</option>';
  $ciudades.forEach(city => {
    if ( city.ciudad === $citySelected){
      cadHtml += `<option selected val="${ city.ciudad }">${ city.ciudad }</option>`;
    }else{
      cadHtml += `<option val="${ city.ciudad }">${ city.ciudad }</option>`;
    }
  });

  $("#citySelect").html(cadHtml);

}

  