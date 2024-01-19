<template>
    <div>
        <div class="message-container">
            <p>{{ msg }}</p>
        </div>
    </div>
</template>

<script>

export default {
    name: "Messagered",
    props: {
        msg: String
    }
}

</script>

<style scoped>
    .message-container {
        padding: 5px 10px 0px 10px;
        background-color: transparent;     
        color: #d31408;
        align-items: center;
        justify-content: center;
        text-align: center;        
    }
   
</style>
