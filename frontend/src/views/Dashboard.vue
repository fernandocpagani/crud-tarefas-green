<template>
  <div>

    <Navbar />
    <div class="main-content">
      <Menu />
      <Entrance />
    </div>

  </div>
</template>

<script>

import Navbar from './../components/Navbar.vue'
import Menu from './../components/Menu.vue'
import Entrance from './../components/Entrance.vue'

export default {
  components: {
    Navbar,
    Menu,
    Entrance,
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

@media(max-width: 490px) {

  .main-content {
    max-width: 489px;
  }

}
</style>