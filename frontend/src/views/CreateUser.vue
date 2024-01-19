<template>
    <div>
        <div id=padding-page>

            <div id="main-container">

                <div class="left-content">

                    <h3 class="title-left-content">Inscreva-se</h3>

                    <form>

                        <input type="hidden" name="type" value="login">

                        <div class="form-group">
                            <label for="name">Nome completo:</label>
                            <input type="name" class="form-control" id="name" name="name" placeholder="Nome completo" v-model="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Endereço de e-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@email.com.br" v-model="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Senha de acesso:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Min. 6 caracteres" v-model="password" minlength="6" required>
                        </div>

                        <div class="buttons">

                            <router-link to="/">
                                <button class="white-button">Já tenho conta</button>
                            </router-link>

                            <div @click="createUser()">
                                <button class="black-button">Cadastrar</button>
                            </div>

                        </div>

                        <Message :msg="msg" v-show="msg" />
                        <Messagered :msg="msgred" v-show="msgred" />
                        

                    </form>

                </div>

                <div class="right-content">

                    <div class="hand"><img src="../../public/maopng.png" alt="mao"></div>

                    <section class="right-text">
                        <h3 class="title-right-content">A fortuna fica ao lado daquele que ousa.</h3>
                        <p class="text-right-content">Todo progresso ocorre fora da zona de conforto.</p>
                    </section>

                    <div class="images">
                        <div class="degrade"></div>
                        <div class="image"></div>
                    </div>

                </div>

            </div>
        </div>

        <footer>
            <h6>Fernando Códolo Pagani &copy 2024</h6>
            <a href="https://www.linkedin.com/in/fernandocpagani/" target="_blank"><img src="../../public/linkedin.svg" alt="icone linkedin"></a>
            <a href="https://www.instagram.com/fernandocpagani/" target="_blank"><img src="../../public/instagram.svg" alt="icone instagram"></a>
            <a href="https://www.facebook.com/fernando.codolopagani/" target="_blank"><img src="../../public/facebook.svg" alt="icone facebook"></a>
            <a href="https://github.com/fernandocpagani" target="_blank"><img  src="../../public/github.svg" alt="icone gihub"></a>
        </footer>

    </div>
</template>

<script>
import axios from 'axios'
import Message from '../components/Message.vue'
import Messagered from '../components/Messagered.vue'

export default {
    name: "CreateUser",
    components: {
        Message,
        Messagered
    },

    data() {
        return {
            email: null,
            name: null,
            password: null,
            msg: '',
            msgred: '',
        }
    },

    methods: {

        async createUser() {
            var that = this
            const data = {
                email: this.email,
                name: this.name,
                password: this.password,
            }

            const result = axios.post('http://localhost:8000/api/auth/register', data)
                .then(function (response) {
                    console.log(response)                   
                    that.msg = "Usuário cadastrado com sucesso!"
                    setTimeout(() => that.msg = "", 3000);  
                })

                .catch(error => {
                    console.log(error);
                    that.msgred = "Usuario não cadastrado"                   
                    setTimeout(() => that.msgred = "", 3000);                
                })    

            this.email = "";
            this.name = "";
            this.password = "";
        }
    }
}

</script>

<style scoped>

#padding-page {
    padding: 31px 61px 27px 31px;
    height: 657px;
    width: 1280px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

#main-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}

.left-content {
    display: flex;
    flex-direction: column;
    width: 535px;
    background-color: #fff;
    justify-content: center;
    box-sizing: border-box;
}

.title-left-content {
    font-size: 27px;
    color: #000E1F;
    font-style: normal;
    font-weight: 800;
    line-height: 180%;
    margin-bottom: 10px;
    line-height: 49px;
    letter-spacing: 0em;
    text-align: left;
}

.form-group {
    display: flex;
    flex-direction: column;
}

label {
    color: #000E1F;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    margin-top: 20px;
    line-height: 29px;
    text-align: left;
}

input {
    height: 55px;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 180%;
    margin-top: 9px;
    border: 1px solid #e5e5e5;
    padding-left: 20px;
    border-radius: 0;
}

.buttons {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 35px;
}

.white-button {
    width: 171px;
    height: 55px;
    border: none;
    background-color: #fff;
    color: #81858E;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 180%;
    cursor: pointer;
    text-align: start;
}

.black-button {
    width: 171px;
    height: 55px;
    background-color: #000;
    color: #fff;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 180%;
    cursor: pointer;
}

.right-content {
    width: 609px;
    height: 599px;
    margin-left: 44px;
    background-color: #f7f7f7;
    transition: 0.5;
}

.hand {
    padding-top: 60px;
    margin-left: 65px;
    font-size: 48px;
    border: none;
}

.right-text {
    padding-top: 152px;
    margin: 0 auto;
    width: 513px;
}

.title-right-content {
    color: #000;
    font-size: 24px;
    font-style: normal;
    font-weight: 700;
    line-height: 36px;
    margin-bottom: 15px;
    transition: 0.5;
    text-align: left;
}

p {
    color: #000;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
    text-align: left;
}

.images {
    margin-top: 93px;
    margin-left: 45px;
    display: flex;
    flex-direction: row;
}

.image {
    margin-left: 35px;
    height: 100px;
    width: 100px;
    background-image: url(./../../public/img3.jpg);
    transition: 0.5;
    border: none;
}

.degrade {
    height: 100px;
    width: 100px;
    background: linear-gradient(270deg, #0000005b 1%, #fff);
}

footer {
    display: flex;
    flex-direction: row;
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translate(-50%, 0);
}

footer img {
    margin-left: 10px;
    margin-bottom: 8px;
    cursor: pointer;
}

@media(max-width: 490px) {

    footer {
        display: block;
        text-align: center;
        position: relative;
        top: 550px;
    }

    #padding-page {
        max-width: 489px;
        position: relative;
        padding: 10px;
        top: 0;
        left: 0;
        transform: translate(0, 0);
    }

    #main-container {
        display: flex;
        flex-direction: column;
    }

    .right-content {
        max-width: 469px;
        height: 669px;
    }

    .right-text {
        max-width: 400px;
        margin: 0 auto;
    }

    .form-group, .buttons {
        width: 470px;
    }

    .images {
        margin-bottom: 86px;
    }

    .buttons {
        margin-bottom: 30px;
    }

    .title-left-content {
        max-width: 400px;
    }

    .right-content {
        max-width: 489;
        margin-left: 0;
        margin-bottom: 10px;
    }

    .left-content {
        max-width: 489px;
    }

}

</style>