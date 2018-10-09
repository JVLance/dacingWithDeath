<template>
    <div class="custom-actions">
      <button class="ui basic button btn btn-danger" @click="itemAction('delete-item', rowData, rowIndex)"><icon name="trash"></icon></button>
    </div>
  </template>

<script>

  import { mapActions } from 'vuex'
  import { mapMutations } from 'vuex';
  import { mapGetters } from 'vuex';
  import router from '@/router'


  export default {
    props: {
      rowData: {
        type: Object,
        required: true
      },
      rowIndex: {
        type: Number
      }
    },
    data () {
        return {
            killing : null
        }
    },
    computed : {
        ...mapGetters({
            recharge  : 'getRecharge'
        })
    },
    methods: {
      ...mapActions({
        deleteHour : 'deleteHour'
      }),
      ...mapMutations({
            setRecharge  : 'setRecharge'
      }),
      dropItem() {
          this.deleteHour(this.killing).then(success => {
                this.setRecharge(!this.recharge);
            }, error => {
                console.log(error);
            });
      },
      itemAction (action, data, index) {
          this.killing = data.id;

          this.$modal.show('dialog', {
                title: 'Deleting appointment!',
                text: 'Are you sure you want to delete this appointment?',
                buttons: [
                    {
                        title: 'Delete',
                        handler: () => { 
                            this.dropItem();
                            this.$modal.hide('dialog');
                         }
                    },
                    {
                        title: 'Close'
                    }
                ]
            })


        
      }
    }
  }
  </script>

  <style>
    .custom-actions button.ui.button {
      padding: 8px 8px;
    }
    .custom-actions button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>