<template>
    <div>
        <div id=padding-page>
            <div id="main-container">

                <div class="left-content">

                    <div class="hand"><img src="../../public/maopng.png" alt="mao"></div>

                    <section class="left-text">
                        <h3 class="title-left-content">A fortuna fica ao lado daquele que ousa.</h3>
                        <p class="text-left-content">Todo progresso ocorre fora da zona de conforto.</p>
                    </section>

                    <div class="images">
                        <div class="degrade"></div>
                        <div class="image"></div>
                    </div>

                </div>

                <div class="right-content">

                    <h3 class="title-right-content">Login</h3>

                    <form>

                        <input type="hidden" name="type" value="login">

                        <div class="form-group">
                            <label for="email">Endereço de e-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@email.com.br" required v-model="email">
                        </div>

                        <div class="form-group">
                            <label for="password">Senha de acesso:</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Min. 6 caracteres" v-model="password" minlength="6">
                        </div>

                        <div class="buttons">
                            <router-link to="/createuser">
                                <button class="white-button">Não tenho conta</button>
                            </router-link>
                            <div>
                                <input class="black-button" value="Acessar" v-on:click="login">
                            </div>
                        </div>

                        <Messagered :msg="msgred" v-show="msgred" />

                    </form>

                </div>
            </div>
        </div>

        <footer>
            <h6>Fernando Códolo Pagani &copy 2024</h6> 
            <a href="https://www.linkedin.com/in/fernandocpagani/" target="_blank"><img src="../../public/linkedin.svg" alt="icone linkedin"></a>
            <a  href="https://www.instagram.com/fernandocpagani/" target="_blank"><img src="../../public/instagram.svg" alt="icone instagram"></a>  
            <a  href="https://www.facebook.com/fernando.codolopagani/" target="_blank"><img src="../../public/facebook.svg" alt="icone facebook"></a>  
            <a  href="https://github.com/fernandocpagani" target="_blank"><img src="../../public/github.svg" alt="icone gihub"></a> 
        </footer>

    </div>
</template>

<script>

import axios from 'axios'
import Messagered from '../components/Messagered.vue'
export default {
    name: "Login",
    components: {
        Messagered
    },

    data() {
        return {
            email: '',
            password: '',
            msgred: null,
        }
    },

    methods: {
        async login() {
            axios.post(`http://127.0.0.1:8000/api/auth/login`, { email: this.email, password: this.password })
                .then((result) => {
                    localStorage.setItem("user-info", JSON.stringify(result.data))
                    this.$router.push({ name: 'dashboard' })
                })

                .catch(error => {
                    this.msgred = "Usuario e/ou senha incorreto(s)"
                    setTimeout(() => this.msgred = "", 3000);
                })
        },
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
    width: 609px;
    height: 599px;
    margin-right: 44px;
    background-color: #f7f7f7;
    transition: 0.5;
}

.hand {
    margin-top: 60px;
    margin-left: 65px;
    font-size: 48px;
    border: none;
    background-color: transparent;
    transition: 0.5s;
}

.left-text {
    padding-top: 152px;
    margin: 0 auto;
    width: 513px;
}

.title-left-content {
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

.right-content {
    display: flex;
    flex-direction: column;
    width: 535px;
    background-color: #fff;
    justify-content: center;
    box-sizing: border-box;
}

.title-right-content {
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
    text-align: center;
    padding: 0;
    margin: 0;
}

.left-content:hover {
    background-color: #000;
}

.left-content:hover .text-left-content,
.left-content:hover .title-left-content {
    color: #fff;
}

.left-content:hover .hand {
    margin-top: 94px;
}

.left-content:hover .image {
    background-image: url(./../../public/img4.jpg);
}

.left-content:hover .degrade {
    background: linear-gradient(90deg, #000 60%, #fff);
}

.left-content:hover .left-text {
    padding-top: 117px;
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
        top: 450px;
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

    .left-content {
        max-width: 469px;
        height: 669px;
        margin: 0;
    }

    .left-text {
        max-width: 400px;
        margin: 0 auto;
    }

    .form-group,
    .buttons {
        width: 470px;
    }

    .images {
        margin-bottom: 86px;
    }

    .title-right-content {
        margin-top: 30px;
        max-width: 400px;
    }

    .buttons {
        margin-bottom: 30px;
    }

    .right-content {
        max-width: 469px;
    }

}

</style>