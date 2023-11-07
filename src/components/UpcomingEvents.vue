<template>
<div class="text-h2 my-font text-center">
      UPCOMING EVENTS
    </div>

    <div class="q-pa-md">
      <div class="row justify-center q-gutter-sm">
        <!-- Existing event -->
        <q-card class="example-card">
          <q-intersection
            :key="0"
            transition="scale"
            class="example-item"
          >
            <q-card-section>
              <div class="text-h4 text-center">Christmas Party</div>
              <div class="text-overline text-center">DECEMBER 22, 2023</div>
              <div class="q-mt-md">
                Join us for a fun-filled Christmas party to celebrate the holiday season with your friends and colleagues. There will be games, food, music, and more!
              </div>
            </q-card-section>
          </q-intersection>
        </q-card>

        <!-- Add 5 more upcoming events for students and teachers -->
        <!-- Event 1 -->
        <q-card class="example-card">
          <q-intersection
            :key="1"
            transition="scale"
            class="example-item"
          >
            <q-card-section>
              <div class="text-h4 text-center">Student Coding Workshop</div>
              <div class="text-overline text-center">JANUARY 10, 2024</div>
              <div class="q-mt-md">
                Join our coding workshop tailored for students to enhance their programming skills. Don't miss this opportunity to learn and explore the world of coding.
              </div>
            </q-card-section>
          </q-intersection>
        </q-card>

        <!-- Event 2 -->
        <q-card class="example-card">
          <q-intersection
            :key="2"
            transition="scale"
            class="example-item"
          >
            <q-card-section>
              <div class="text-h4 text-center">Teacher Training Seminar</div>
              <div class ="text-overline text-center">FEBRUARY 15, 2024</div>
              <div class="q-mt-md">
                Teachers, join our seminar to learn about the latest educational technologies and techniques. Enhance your teaching skills and stay updated with modern teaching methods.
              </div>
            </q-card-section>
          </q-intersection>
        </q-card>

        <!-- Event 3 -->
        <q-card class="example-card">
          <q-intersection
            :key="3"
            transition="scale"
            class="example-item"
          >
            <q-card-section>
              <div class="text-h4 text-center">Student Art Exhibition</div>
              <div class="text-overline text-center">MARCH 20, 2024</div>
              <div class="q-mt-md">
                Explore the creativity of our students at the annual art exhibition. View stunning artworks created by our talented students and support their artistic endeavors.
              </div>
            </q-card-section>
          </q-intersection>
        </q-card>

        <!-- Event 4 -->
        <q-card class="example-card">
          <q-intersection
            :key="4"
            transition="scale"
            class="example-item"
          >
            <q-card-section>
              <div class="text-h4 text-center">Teacher-Parent Conference</div>
              <div class="text-overline text-center">APRIL 5, 2024</div>
              <div class="q-mt-md">
                Discuss your child's progress with our teachers during the teacher-parent conference. It's a great opportunity to collaborate and support your child's education.
              </div>
            </q-card-section>
          </q-intersection>
        </q-card>

        <!-- Event 5 -->
        <q-card class="example-card">
          <q-intersection
            :key="5"
            transition="scale"
            class="example-item"
          >
            <q-card-section>
              <div class="text-h4 text-center">Student Game Development Competition</div>
              <div class="text-overline text-center">MAY 15, 2024</div>
              <div class="q-mt-md">
                Calling all student programmers and game enthusiasts! Join our game development competition and showcase your game development skills. Exciting prizes await the winners.
              </div>
            </q-card-section>
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
};
</script>
<style lang="sass" scoped>
    
      
      .my-font
        font-family: 'Lugrasimo', cursive /* Use 'cursive' as the generic font family in case Lugrasimo isn't available */
        
      @font-face
        font-family: 'Lugrasimo'
        src: url('https://fonts.gstatic.com/s/lugrasimo/v7/PCjtKkPp9Wp9RB2QBkREtefKlbNvSdKsN9e-pQ.woff2') format('woff2') /* URL for the Lugrasimo font */
        font-weight: normal
        font-style: normal

        .q-item-section-divider
        height: 1px
        background-color: #ddd
        margin: 8px 0

        .example-item
            height: 290px
            width: 290px

      </style>
