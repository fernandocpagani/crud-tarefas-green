<template>
    <div class="main-content">

        <div class="menu">
            <router-link to="/dashboard"> <button class="first-menu-button"><img src="../../public/entrada.svg" alt="">Entrada</button></router-link>
            <router-link to="/todaytaskview"> <button class="menu-button"><img src="../../public/tarefasdehoje.svg" alt="">Tarefas de hoje</button></router-link>
            <router-link to="/delaytaskview"> <button class="menu-button"><img src="../../public/vencidos.svg" alt="">Vencidos</button></router-link>
        </div>

        <footer class="footer-items">
            <h6>Fernando Códolo Pagani </h6>
            <h6>&copy 2024</h6>
            <div class="icons">
                <a href="https://www.linkedin.com/in/fernandocpagani/" target="_blank"><img src="../../public/linkedin.svg" alt="icone linkedin"></a>
                <a href="https://www.instagram.com/fernandocpagani/" target="_blank"><img src="../../public/instagram.svg" alt="icone instagram"></a>
                <a href="https://www.facebook.com/fernando.codolopagani/" target="_blank"><img src="../../public/facebook.svg" alt="icone facebook"></a>
                <a href="https://github.com/fernandocpagani" target="_blank"><img src="../../public/github.svg" alt="icone gihub"></a>
            </div>
        </footer>

    </div>
</template>

<script>

export default {
    name: "Menu",
}

</script>

<style scoped>
.main-content {
    width: 293px;
    height: 100%;
    position: fixed;
}

.menu {
    background-color: #fafafa;
    width: 293px;
    padding: 0;
    margin-top: 70px;
}

.first-menu-button {
    background-color: #fafafa;
    border: none;
    font-size: 15px;
    font-weight: 600px;
    line-height: 18.29px;
    margin-left: 46px;
    margin-top: 63px;
    cursor: pointer;
}

.first-menu-button img {
    margin-right: 20px;
}

.menu-button {
    background-color: #fafafa;
    border: none;
    font-size: 15px;
    font-weight: 600px;
    line-height: 18.29px;
    margin-left: 46px;
    margin-top: 45px;
    cursor: pointer;
}

.menu-button img {
    margin-right: 20px;
}

.footer-items {
    text-align: center;
    position: absolute;
    bottom: 0;
    justify-items: center;
    width: 293px;
}

.icons img {
    margin-left: 10px;
    margin-bottom: 8px;
    cursor: pointer;
}

@media(max-width: 490px) {
    
    .footer-items{        
        display: none;        
    }  

    .main-content {
        height: 50px;
        width: 489px;
        position: fixed;
        top: 70px;
        background-color: #fafafa;
    }

    .menu {
        display: flex;
        flex-direction: row;
        width: 100%;
        padding: 0;
        margin: 0;        
        justify-content: space-between;
        padding: 10px 15px;
    }

    .first-menu-button {
        margin: 0;
    }

    .first-menu-button img {
        margin: 0;
        padding-right: 10px;
    }

    .menu-button {
        margin: 0;
    }

    .menu-button img {
        margin: 0;
        padding-right: 10px;
    }

}

</style>