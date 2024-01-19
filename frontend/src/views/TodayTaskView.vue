<template>
<div>

  <Navbar />
  <div class="main-content">
     <Menu />
    <TodayTask /> 
  </div> 

</div>
</template>

<script>

import Navbar from './../components/Navbar.vue'
import Menu from './../components/Menu.vue'
import TodayTask from './../components/TodayTask.vue'

export default {
  components: {
    Navbar,
    Menu,
    TodayTask,
  },
}

</script>

<style scoped>
.main-content {
  max-width: 1280px;
  display: flex;
  grid-template-columns: repeat(2, 1fr);  
  margin: auto;
}

</style>