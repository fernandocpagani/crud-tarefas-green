<template>
  <div>
    <b-button v-b-modal.modal-sm variant="black">Criar tarefa</b-button>

    <b-modal id="modal-sm" size="sm" title="Small Modal" body-class="p-0 " hide-header hide-footer centered>

      <form id="form">

        <div>
          <input type="name" id="task-name" name="task-name" placeholder="Nome da tarefa" maxlength="30" v-model="title">
        </div>

        <div>
          <input type="name" id="task-description" name="task-description" maxlength="50" placeholder="Descrição" v-model="description">
        </div>

        <div class="button-date">
          <img src="../../public/calendario.svg" alt="">
          <input placeholder="Data de vencimento" class="date" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" v-model="date">
        </div>

        <div class="buttons">
          <button class="white-button" @click="close()">Cancelar</button>
          <div class="button" @click="createTask()">
            <input type="button" class="black-button" value="Criar tarefa">
          </div>
        </div>

      </form>

    </b-modal>
  </div>
</template>

<script>

import axios from 'axios'

export default {
  name: "ModalNewTask",

  data() {
    return {
      modalShow: false,
      title: null,
      description: null,
      date: null,
      users_id: null,
    }
  },

  computed: {
    isLogged() {
      if (localStorage.getItem("user-info")) {
        return true
      } else {
        return this.$router.push({ name: "login" })
      }
    }
  },

  methods: {

    async createTask() {

      const user = JSON.parse(localStorage.getItem("user-info"))
      const data = {
        title: this.title,
        description: this.description,
        finishdate: this.date,
        users_id: user.user.id,
      }

      axios.post('http://localhost:8000/api/task/register', data)
        .then(function (response) {
          console.log(response);
          window.location = window.location;
          window.location.reload();
        })
        .catch(function (error) {
          console.error(error);
        });        
    },

  }
}
</script>

<style scoped>

body {
  min-height: 100vh;
  display: grid;
  place-content: center;
}

a {
  text-decoration: none;
}

.btn {
  border: none;
  color: #81858e;
  font-size: 15px;
}

#form {
  width: 678px;
  height: 216px;
  background-color: #fff;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

#task-name {
  font-size: 16px;
  font-weight: 400;
  line-height: 20px;
  margin-top: 21px;
  margin-left: 25px;
  border: none;
}

#task-description {
  font-size: 14px;
  font-weight: 400;
  line-height: 17px;
  margin-top: 15px;
  margin-left: 25px;
  margin-bottom: 20px;
  border: none;
}

.button-date {
  margin-left: 25px;
  width: 199px;
  height: 40px;
  box-sizing: border-box;
  border: solid 1px #e5e5e5;
  background-color: #fff;
  margin-bottom: 15px;
  display: flex;
  flex-direction: row;
}

.button-date img {
  height: 14px;
  width: 14px;
  margin: 13px 14px 10px 13px;
}

.date {
  border: none;
  font-size: 14px;
}

.buttons {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  margin-top: 15px;
}

.white-button {
  width: 122px;
  height: 40px;
  border: none;
  background-color: #f7f7f7;
  color: #000;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 17.07px;
  cursor: pointer;
  text-align: center;
  padding: 12px 0;
  margin-left: 380px;
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
  margin-left: 15px;
}

.buttons {
  border-top: solid 1px #e5e5e5;
  padding: 14px 25px;
}

.btn,
.btn-secondary {
  background-color: transparent;
  color: #fff
}

.btn:hover,
.btn-secondary:hover {
  background-color: transparent;
  color: #fff;
}

@media(max-width: 490px) {

  form {
    max-width: 470px;
  }

  .white-button {
    margin-left: 150px;
  }

}

</style>