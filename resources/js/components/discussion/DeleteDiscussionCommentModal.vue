<template>
    <div>
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper" @click.self="$emit('close')">
                    <div class="modal-container">
                    
                        <div class="modal-header">
                            <slot name="header">
                                <!--default header-->
                            </slot>
                        </div>
                        
                        <div class="modal-body">
                            <slot name="body">
                                <p>{{ comment }}</p>
                            </slot>
                        </div>
                    
                        <div class="modal-footer">
                            <slot name="footer">
                                <div class="btn-wrapper">
                                    <button class="button is-small btn-del" @click="handleDeleteComment(comment_id)">
                                        削除
                                    </button>
                                </div>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    data() {
        return {
            
        }
    },
    props: {
        comment: String,
        discussion_id: Number,
        user_id: Number,
        comment_id: Number,
        club_id: Number,
        handleDeleteComment: Function
    },
}
</script>

<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}
.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}
.modal-body {
  margin: 20px 0;
  text-align: center;
}
.modal-default-button {
  float: right;
  border: 1px solid #00aaff;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
.edit-comment-input {
    border: 1px solid #aaa;
    width: 90%;
}

.btn-wrapper {
    text-align: right;
}
.btn-del {
    background-color: rgba(242, 27, 7, 100);
    border: none;
    border-radius: 3px;
    color: white;
    font-weight: bold;
    margin-bottom: 3px;
    /*width: 12%;*/
}
</style>