<template>
  <div>
    <b-button v-b-modal.modal-user variant="black"><label class="first-letter">{{ name }}</label></b-button>

    <b-modal id="modal-user" size="sm" title="Small Modal" body-class="p-0 " hide-header hide-footer centered>

      <div id="main-content">

        <div class="user-info">

          <h5 class="title">Informações do usuário</h5>

          <h4 class="title-info">Nome completo</h4>
          <h5 class="info-black">{{ fullname }}</h5>

          <h4 class="title-info">E-mail</h4>
          <h5 class="info-black">{{ email }}</h5>

          <h4 class="title-info">Conta criada em</h4>
          <h5 class="info-black"><img src="../../public/datapreto.svg" alt="calendario-preto"> {{ moment(created).format('DD/MM/YYYY') }}</h5>

          <h4 class="title-info">ID da conta</h4>
          <h5 class="info-black">{{ id }}</h5>

        </div>

        <div class="buttons">
          <button class="black-button" @click="$bvModal.hide('modal-user')">OK</button>
        </div>

      </div>

    </b-modal>
  </div>
</template>

<script>

import moment from 'moment'

export default {
  name: "ModalUser",

  data() {
    return {
      name: null,
      fullname: null,
      email: null,
      created: null,
      moment: null,
    }
  },

  mounted() {
    let user = localStorage.getItem('user-info');
    this.name = JSON.parse(user).user.name[0].toUpperCase();
    this.fullname = JSON.parse(user).user.name;
    this.email = JSON.parse(user).user.email;
    this.created = JSON.parse(user).user.created_at;
    this.id = JSON.parse(user).user.id;
    this.moment = moment;  
  },
}

</script>

<style scoped>

.btn, .btn-black {
  padding: 0;
}

.first-letter {
  margin: 0 22.5px;
  height: 30px;
  width: 30px;
  background-color: #009488;
  text-align: center;
  color: #fff;
  font-weight: bold;
  border-radius: 100%;
  font-size: 20px;
  border: none;
  padding: 0;
  cursor: pointer;
}

#main-content {
  width: 400px;
  height: 452px;
  background-color: #fff;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.user-info {
  padding: 30px 30px 0 30px;
}

.title {
  font-size: 24px;
  margin-bottom: 30px;
}

.title-info {
  font-size: 14px;
  font-weight: 400;
  line-height: 17px;
  text-align: left;
  margin-bottom: 5px;
  color: #81858e;
}

.info-black {
  font-size: 14px;
  font-weight: 600;
  line-height: 17px;
  text-align: left;
  margin-bottom: 25px;
  color: #000;
}

img {
  padding-right: 10px;
}

.buttons {
  border-top: solid 1px #e5e5e5;
  display: flex;
  flex-direction: row;
  justify-content: center;
  margin-top: 30px;
}

.black-button {
  width: 122px;
  height: 40px;
  background-color: #000;
  color: #fff;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 17.07px;
  cursor: pointer;
  margin: 30px;
}

</style>