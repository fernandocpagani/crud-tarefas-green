<template>    
    <nav>

        <div class="nav-content">

            <div class="hand"><img src="../../public/maonavbar.png" alt="mao"></div>

            <div class="menu">
                <img class="nav-add" src="../../public/adicionar.svg" alt="adicionar">
                <button class="hidden"> <ModalNewTask /> </button>                
                <button class="button-modal-user"><ModalInfo /></button>
                <img class="nav-button" src="../../public/sino.svg" alt="sino">
                <button class="button-modal-user"><ModalUser /></button>
                <a v-on:click="logout" href="/" class="out-button">Sair</a>
            </div>
            
        </div>

    </nav>
</template>

<script>

import ModalNewTask from './../components/ModalNewTask.vue'
import ModalUser from './../components/ModalUser.vue'
import ModalInfo from './../components/ModalInfo.vue'

export default {
    name: "Navbar",
    components: {
        ModalNewTask,
        ModalUser,
        ModalInfo
    },
    data() {
        return {
            name: null,

        }
    },

    methods: {
        logout() {
            localStorage.clear();
            this.$router.push({ name: "login" })
        }
    },
}

</script>

<style scoped>

nav {
    background-color: #000;
    width: 100%;
    position: fixed;
    padding: 0 5px;
}

.nav-content {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    height: 70px;
    align-items: center;
    margin: 0 auto;
    max-width: 1280px;
}

.hand {
    font-size: 28px;
    margin-left: 26px;
}

.menu {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.menu:hover .hidden {
    display: block;
    padding: 0;
}

.hidden {
    align-items: center;
    background-color: transparent;
    border: none;
    display: none;
    cursor: pointer;
}

.nav-add {
    font-size: 14px;
    padding: 0;
}

.nav-button {
    padding: 0 22.5px;
}

.out-button{    
font-size: 15px;
font-weight: 600;
line-height: 18px;
letter-spacing: 0em;
text-align: left;
margin: 0 22.5px;
color: #fff;
text-decoration: none;
}

.button-modal-user{
    border: none;
    background-color: #000;
}

@media(max-width: 490px) {

    nav {
        max-width: 489px;
        position: fixed;
    }

}

</style>