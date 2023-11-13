<template>
  <div class="text-h2 my-font text-center ">
        Events
    </div>
    
    <div class="q-pa-md row q-gutter-md q-col-gutter-md justify-center">
      <div class="row justify-center q-gutter-md q-col-lg-3 q-col-md-4 q-col-6 q-col-xs-12">
      <q-card class="example-card my-card" :style="{ maxWidth: '290px', height: computeCardHeight('Christmas Party') }">
      <q-intersection
        withtransition="scale"
        class="example-item"
      >
        <q-card flat bordered class="q-ma-md">

          <q-card-section class="announcement-section">
            <div class="text-h4 text-center">Christmas Party</div>
              <div class="text-overline text-center">DECEMBER 22, 2023</div>
              <div class="q-mt-md announcement-text">
                Join us for a fun-filled Christmas party to celebrate the holiday season with your friends and colleagues. There will be games, food, music, and more!
              </div>
          </q-card-section>
        </q-card>
      </q-intersection>
      </q-card>

      <q-card class="example-card my-card" :style="{ maxWidth: '290px', height: computeCardHeight('Christmas Party') }">
      <q-intersection
        withtransition="scale"
        class="example-item"
      >
        <q-card flat bordered class="q-ma-md">

          <q-card-section class="announcement-section">
            <div class="text-h4 text-center">Student Coding Workshop</div>
              <div class="text-overline text-center">JANUARY 10, 2024</div>
              <div class="q-mt-md announcement-text">
                Join our coding workshop tailored for students to enhance their programming skills. Don't miss this opportunity to learn and explore the world of coding.
              </div>
          </q-card-section>
        </q-card>
      </q-intersection>
      </q-card>

      <q-card class="example-card my-card" :style="{ maxWidth: '290px', height: computeCardHeight('Christmas Party') }">
      <q-intersection
        withtransition="scale"
        class="example-item"
      >
        <q-card flat bordered class="q-ma-md">

          <q-card-section class="announcement-section">
            <div class="text-h4 text-center">Teacher Training Seminar</div>
              <div class="text-overline text-center">FEBRUARY 15, 2024</div>
              <div class="q-mt-md announcement-text">
                Teachers, join our seminar to learn about the latest educational technologies and techniques. Enhance your teaching skills and stay updated with modern teaching methods.
              </div>
          </q-card-section>
        </q-card>
      </q-intersection>
      </q-card>

      <q-card class="example-card my-card" :style="{ maxWidth: '290px', height: computeCardHeight('Christmas Party') }">
      <q-intersection
        withtransition="scale"
        class="example-item"
      >
        <q-card flat bordered class="q-ma-md">

          <q-card-section class="announcement-section">
            <div class="text-h4 text-center">Student Art Exhibition</div>
              <div class="text-overline text-center">MARCH 20, 2024</div>
              <div class="q-mt-md announcement-text">
                Explore the creativity of our students at the annual art exhibition. View stunning artworks created by our talented students and support their artistic endeavors.
              </div>
          </q-card-section>
        </q-card>
      </q-intersection>
      </q-card>

      <q-card class="example-card my-card" :style="{ maxWidth: '290px', height: computeCardHeight('Christmas Party') }">
      <q-intersection
        withtransition="scale"
        class="example-item"
      >
        <q-card flat bordered class="q-ma-md">

          <q-card-section class="announcement-section">
            <div class="text-h4 text-center">Teacher-Parent Conference</div>
              <div class="text-overline text-center">APRIL 5, 2024</div>
              <div class="q-mt-md announcement-text">
                Discuss your child's progress with our teachers during the teacher-parent conference. It's a great opportunity to collaborate and support your child's education.
              </div>
          </q-card-section>
        </q-card>
      </q-intersection>
      </q-card>

      <q-card class="example-card my-card" :style="{ maxWidth: '290px', height: computeCardHeight('Christmas Party') }">
      <q-intersection
        withtransition="scale"
        class="example-item"
      >
        <q-card flat bordered class="q-ma-md">

          <q-card-section class="announcement-section">
            <div class="text-h4 text-center">Student Game Development Competition</div>
              <div class="text-overline text-center">MAY 15, 2024</div>
              <div class="q-mt-md announcement-text">
                Calling all student programmers and game enthusiasts! Join our game development competition and showcase your game development skills. Exciting prizes await the winners.
              </div>
          </q-card-section>
        </q-card>
      </q-intersection>
      </q-card>

      <q-card class="example-card my-card" :style="{ maxWidth: '290px', height: computeCardHeight('Christmas Party') }">
      <q-intersection
        withtransition="scale"
        class="example-item"
      >
        <q-card flat bordered class="q-ma-md">

          <q-card-section class="announcement-section">
            <div class="text-h4 text-center">Christmas Party</div>
              <div class="text-overline text-center">DECEMBER 22, 2023</div>
              <div class="q-mt-md announcement-text">
                Join us for a fun-filled Christmas party to celebrate the holiday season with your friends and colleagues. There will be games, food, music, and more!
              </div>
          </q-card-section>
        </q-card>
      </q-intersection>
      </q-card>

      <q-card class="example-card my-card" :style="{ maxWidth: '290px', height: computeCardHeight('Christmas Party') }">
      <q-intersection
        withtransition="scale"
        class="example-item"
      >
        <q-card flat bordered class="q-ma-md">

          <q-card-section class="announcement-section">
            <div class="text-h4 text-center">Christmas Party</div>
              <div class="text-overline text-center">DECEMBER 22, 2023</div>
              <div class="q-mt-md announcement-text">
                Join us for a fun-filled Christmas party to celebrate the holiday season with your friends and colleagues. There will be games, food, music, and more!
              </div>
          </q-card-section>
        </q-card>
      </q-intersection>
      </q-card>

      <q-card class="example-card my-card" :style="{ maxWidth: '290px', height: computeCardHeight('Christmas Party') }">
      <q-intersection
        withtransition="scale"
        class="example-item"
      >
        <q-card flat bordered class="q-ma-md">

          <q-card-section class="announcement-section">
            <div class="text-h4 text-center">Christmas Party</div>
              <div class="text-overline text-center">DECEMBER 22, 2023</div>
              <div class="q-mt-md announcement-text">
                Join us for a fun-filled Christmas party to celebrate the holiday season with your friends and colleagues. There will be games, food, music, and more!
              </div>
          </q-card-section>
        </q-card>
      </q-intersection>
      </q-card>

      <q-card class="example-card my-card" :style="{ maxWidth: '290px', height: computeCardHeight('Christmas Party') }">
      <q-intersection
        withtransition="scale"
        class="example-item"
      >
        <q-card flat bordered class="q-ma-md">

          <q-card-section class="announcement-section">
            <div class="text-h4 text-center">Christmas Party</div>
              <div class="text-overline text-center">DECEMBER 22, 2023</div>
              <div class="q-mt-md announcement-text">
                Join us for a fun-filled Christmas party to celebrate the holiday season with your friends and colleagues. There will be games, food, music, and more!
              </div>
          </q-card-section>
        </q-card>
      </q-intersection>
      </q-card>
  </div>
</div>
</template>

<script>
import { ref } from 'vue';

export default {
  setup() {
    return {
      tab: ref('one'),
    };
  },
  methods: {
    computeCardHeight(text) {
      // Adjust the multiplier as needed for better responsiveness
      const maxHeight = 290 + text.length * 5;
      return `clamp(100px, ${maxHeight}px, 400px)`;
    },
  },
};
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 250px
  border-radius: 12px

.my-font
  font-family: 'Lugrasimo', cursive

@font-face
  font-family: 'Lugrasimo'
  src: url('https://fonts.gstatic.com/s/lugrasimo/v7/PCjtKkPp9Wp9RB2QBkREtefKlbNvSdKsN9e-pQ.woff2') format('woff2')
  font-weight: normal
  font-style: normal

.q-item-section-divider
  height: 1px
  background-color: #ddd
  margin: 8px 0

.example-item
  height: 290px
  width: 290px

.q-mt-md
  max-height: clamp(100px, 30vh, 200px)
  overflow: hidden

.announcement-section
  background-color: purple
  padding: 12px
  border-radius: 8px

.announcement-text
  color: #fff
</style>
