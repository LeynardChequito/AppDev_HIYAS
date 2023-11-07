<template>
  <div class="q-pa-md q-gutter-lg row justify-center">
    <div class="q-gutter-md row q-pa-sm items-start col-12 col-md-7 justify-center">
      <div class="col-12">
        <h3 class="text-center" style="margin-bottom: 8px; margin-top: 10px;">Announcements</h3>
      </div>

      <q-card v-for="announcement in announcements" :key="announcement.id" class="my-card col-sm-12 col-md-5 q-mb-md">
        <q-card-section horizontal>
          <q-img class="col-5" :src="announcement.image" />
          <q-card-section>
            {{ announcement.content }}
          </q-card-section>
        </q-card-section>

        <q-separator />

        <q-card-actions class="justify-center text-center">
          <div class="text-h6 q-mb-xs text-center text-weight-bold">{{ announcement.title }}</div>
          <text-body2>{{ announcement.date }}</text-body2>
        </q-card-actions>
      </q-card>
    </div>

    <div class="q-pa-md row items-start q-gutter-md col-sm-12 col-md-4 justify-center">
      <q-timeline color="green">
        <q-timeline-entry heading body="Upcoming Events" />

        <q-timeline-entry v-for="event in upcomingEvents" :key="event.id" :title="event.title" :subtitle="event.date" :icon="event.icon" :body="body" />
      </q-timeline>
    </div>
  </div>
</template>

<script>
export default {
  setup() {
    const lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
    const body = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua';

    const announcements = [
      {
        id: 1,
        title: 'Weekly Learning Activity',
        date: 'Sept. 09, 2023 (Monday) 7:30 PM',
        image: require('@/assets/images/WLA.jpg'),
        content: lorem,
      },
      {
        id: 2,
        title: 'MOA Signing',
        date: 'Sept. 09, 2023 (Monday) 7:30 PM',
        image: require('@/assets/images/MOA-signing.jpg'),
        content: lorem,
      },
      {
        id: 3,
        title: 'Letter Writing',
        date: 'Sept. 09, 2023 (Monday) 7:30 PM',
        image: require('@/assets/images/letter-writing.jpg'),
        content: lorem,
      },
      {
        id: 4,
        title: 'Medical and Dental Checkup',
        date: 'Sept. 09, 2023 (Monday) 7:30 PM',
        image: require('@/assets/images/medical-checkup.jpeg'),
        content: lorem,
      },
    ];

    const upcomingEvents = [
      {
        id: 1,
        title: 'Christmas Party',
        date: 'December 22, 2023',
        icon: 'celebration',
      },
      {
        id: 2,
        title: 'Fun Run',
        date: 'January 22, 2024',
        icon: 'directions_run',
      },
      {
        id: 3,
        title: 'Love Month',
        date: 'February 15, 2024',
        icon: 'favorite',
      },
    ];

    return {
      announcements,
      upcomingEvents,
      body,
    };
  },
};
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 350px
.text-h6
  white-space: nowrap
  overflow: hidden
  text-overflow: ellipsis
  max-width: 100%
</style>