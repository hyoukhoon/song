<style>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  display: table;
  transition: opacity .3s ease;
  
  &-wrapper {
    display: table-cell;
    vertical-align: middle;
  }
  
  &-container {
    background: #fff;
    width: 450px;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
    margin: 0 auto;
    padding: 20px 30px;
  }
  
  &-footer {
    margin-top: 15px;
  }
  
  &-enter, &-leave {
    opacity: 0;
  }
  
  &-enter &-container,
  &-leave &-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
  }
}

</style>
<div id="modal-app" class="uk-container uk-container-center uk-margin-top">
  <button v-on="click: showModal = true" class="uk-button uk-button-primary">Show Modal</button>
  
  <modal show="{{@showModal}}">
    <div class="modal-header">
      <h3>
        Hello Vue.JS
      </h3>
    </div>
  </modal>
</div>
<template id="modal-template">
  <div class="modal" v-show="show" v-transition="modal">
    <div class="modal-wrapper">
      <div class="modal-container">
        <content select=".modal-header">
          <div class="modal-header">
            <h3>
              Hello World
            </h3>
          </div>
        </content>
        <div class="modal-body">
          I said hello to world not you
        </div>
        <div class="modal-footer uk-clearfix">
            <button v-on="click: show = false" class="uk-button uk-button-success uk-float-right">Ok, I hear!</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// register modal component
Vue.component('modal', {
  template: '#modal-template',
  props: {
    show: {
      type: Boolean,
      required: true,
      twoWay: true  
    }
  }
});

new Vue({
  el: '#modal-app',
  data: {
    showModal: false
  }
});
</script>

<script src="https://unpkg.com/vue/dist/vue.js"></script>