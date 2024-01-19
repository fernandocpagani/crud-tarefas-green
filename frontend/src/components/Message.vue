<template>
    <div>
        <div class="message-container">
            <p>{{ msg }}</p>
        </div>
    </div>
</template>

<script>

export default {
    name: "Message",
    props: {
        msg: String
    }
}

</script>

<style scoped>
    .message-container {
        padding: 5px 10px 0px 10px;
        background-color: transparent;     
        color: #009488;
        align-items: center;
        justify-content: center;
        text-align: center;        
    }
   
</style>
