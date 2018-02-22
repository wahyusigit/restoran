<template>
  <div class="container">
      <button class="btn btn-default" @click="showModal = true">Show modal</button>
      <modal title="Modal title" :show.sync="showModal" :backdrop="false" effect="zoom" >
        <div slot="modal-header" class="modal-header">
          <h4 class="modal-title">Modal <b>Title</b></h4>
        </div>
        <div slot="modal-body" class="modal-body">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div slot="modal-footer" class="modal-footer">
          <button @click="showModal = false" type="button" class="btn btn-default">Close</button>
        </div>
      </modal>
      
    </div>
</template>

<script>
var modal = require('vue-strap').modal;
var alert = require('vue-strap').alert;

export default {
  components: {
    modal,
    alert
  },
  data () {
    return {
      showModal: false,
      fadeModal: false,
      zoomModal: false,
      showCustomModal: false,
      largeModal: false,
      smallModal: false
    }
  }
}
</script>