<template>
  <div class="home">
    <Map title="Mon nouveau titre de composant"/>
  </div>
</template>

<script>
// @ is an alias to /src
import Map from "@/components/Map.vue";
export default {
  name: "Home",
  components: {
   Map,
  },
};
</script>
