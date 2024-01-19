<template>
  <div>
    <b-button v-b-modal.modal-info variant="black"><img class="nav-button2" src="../../public/interrogacao.svg" alt="interrogacao"> </b-button>

    <b-modal id="modal-info" size="sm" title="Small Modal" body-class="p-0 " hide-header hide-footer centered>

      <div id="main-content">

        <div class="user-info">

          <h5 class="title">Projeto - Crud de Tarefas</h5> 

          <h4 class="title-info">Protótipo criado por</h4>
          <h5 class="info-black">Green</h5>

          <h4 class="title-info">Desenvolvido por</h4>
          <h5 class="info-black">Fernando Códolo Pagani</h5>

          <h4 class="title-info">Linguagens utilizadas</h4>
          <h5 class="info-black2">Frontend: Vue JS</h5>
          <h5 class="info-black">Backend: Laravel PHP</h5>

         <div class="social">
          <a href="https://www.linkedin.com/in/fernandocpagani/" target="_blank"><img src="../../public/linkedin.svg" alt="icone linkedin"></a>
          <a href="https://www.instagram.com/fernandocpagani/" target="_blank"><img  src="../../public/instagram.svg" alt="icone instagram"></a>
          <a href="https://www.facebook.com/fernando.codolopagani/" target="_blank"><img src="../../public/facebook.svg" alt="icone facebook"></a>
          <a href="https://github.com/fernandocpagani" target="_blank"><img src="../../public/github.svg" alt="icone gihub"></a>
         </div>

        </div>

        <div class="buttons">
          <button class="black-button" @click="$bvModal.hide('modal-info')">OK</button>
        </div>

      </div>

    </b-modal>
  </div>
</template>

<script>

import moment from 'moment'

export default {
  name: "ModalInfo",

  data() {
    return {
      name: null,
      fullname: null
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

.nav-button2 {
    padding: 0 22.5px 0 35px;
}

#main-content {
  width: 400px;
  height: 472px;
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

.info-black2 {
  font-size: 14px;
  font-weight: 600;
  line-height: 17px;
  text-align: left;
  margin-bottom: 5px;
  color: #000;
}

img {
  padding-right: 10px;
}

.social{
  justify-content: space-between;
  display: flex;
  flex-direction: row;
  padding: 0 20px;
}

.social img{
  width: 40px;
  height: 40px;
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