<template>
  <div class="slider-container">

    <q-carousel arrows animated v-model="slide" infinite :autoplay="autoplay" height="515px">
      <q-carousel-slide name="first" img-src="@/assets/images/Children.jpeg">
        <div class="row image-overlay self-center">
          <br><br><br>
          <div class="text-h4 self-center col-12">Proverbs 22:6
            <div class="text-body2">“Train up a child in the way he should go and when he is old he will not depart
              from
              it” </div>
          </div>
        </div>
      </q-carousel-slide>
      <q-carousel-slide name="second" img-src="@/assets/images/Children2.jpg">
        <div class="image-overlay">
          <div class="absolute-bottom custom-caption">
            <div class="text-h2">Second stop</div>
            <div class="text-subtitle1">The least one shall become a clan, and the smallest one a mighty nation; I am the LORD; in its time I will hasten it.</div>
          </div>
        </div>
      </q-carousel-slide>
      <q-carousel-slide name="third" img-src="@/assets/images/Children3.jpg">
        <div class="image-overlay">
          <div class="absolute-bottom custom-caption">
            <div class="text-h2">Third stop</div>
            <div class="text-body1">Famous Bridge</div>
          </div>
        </div>
      </q-carousel-slide>
    </q-carousel>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'

export default {
  setup() {
    const slide = ref('first');
    const autoplay = ref(30000); // 10 seconds in milliseconds

    // Automatically change the slide after the specified time
    onMounted(() => {
      const carousel = setInterval(() => {
        if (slide.value === 'first') {
          slide.value = 'second';
        } else if (slide.value === 'second') {
          slide.value = 'third';
        } else {
          slide.value = 'first';
        }
      }, autoplay.value);

      // Clear the interval when the component is unmounted
      return () => {
        clearInterval(carousel);
      };
    });

    return {
      slide,
      autoplay,
    };
  },
};
</script>
  
<style lang="sass" scoped>
  .image-overlay 
    position: absolute
    top: 0
    left: 0
    width: 100%
    height: 100%
    background-color: rgba(0, 0, 0, 0.5)
    text-align: left
    padding: 12px
    color: white

  </style>
  