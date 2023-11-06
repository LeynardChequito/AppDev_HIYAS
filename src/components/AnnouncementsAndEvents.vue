<template>
  <div class="q-pa-md q-gutter-lg row one justify-center">
    <div class="q-gutter-md row q-pa-sm  items-start col-12 col-md-7 two justify-center ">
      <div class="col-12 four">
        <h3 class="text-center" style="margin-bottom: 8px; margin-top: 10px;">Announcements</h3>
      </div>

      <!---->
      <q-card class="my-card col-5 col-md-5">
        <q-card-section horizontal>
          <q-img class="col-5" src="@/assets/images/WLA.jpg" />
          <q-card-section>
            {{ lorem }}
          </q-card-section>
        </q-card-section>

        <q-separator />

        <q-card-actions class="justify-center text-center">
          <div class="text-h5 q-mt-sm q-mb-xs text-center text-weight-bold" name="WLA">Weekly Learning Activity</div>
          <text-body2>Sept. 09, 2023 (Monday)<br>7:30 PM</text-body2>
        </q-card-actions>
      </q-card>
      <!---->
      <q-card class="my-card col-5 col-md-5">
        <q-card-section horizontal>
          <q-img class="col-5" src="@/assets/images/MOA-signing.jpg" />
          <q-card-section>
            {{ lorem }}
          </q-card-section>
        </q-card-section>

        <q-separator />

        <q-card-actions class="justify-center text-center">
          <div class="text-h5 q-mt-sm q-mb-xs text-center text-weight-bold">MOA Signing</div>
          <text-body2>Sept. 09, 2023 (Monday)<br>7:30 PM</text-body2>
        </q-card-actions>
      </q-card>

      <q-card class="my-card col-5 col-md-5">
        <q-card-section horizontal>
          <q-img class="col-5" src="@/assets/images/letter-writing.jpg" />
          <q-card-section>
            {{ lorem }}
          </q-card-section>
        </q-card-section>

        <q-separator />

        <q-card-actions class="justify-center text-center">
          <div class="text-h5 q-mt-sm q-mb-xs text-center text-weight-bold">Letter Writing</div>
          <text-body2>Sept. 09, 2023 (Monday)<br>7:30 PM</text-body2>
        </q-card-actions>
      </q-card><q-card class="my-card col-5 col-md-5">
        <q-card-section horizontal>
          <q-img class="col-5" src="@/assets/images/medical-checkup.jpeg" />
          <q-card-section>
            {{ lorem }}
          </q-card-section>
        </q-card-section>

        <q-separator />

        <q-card-actions class="justify-center text-center">
          <div class="text-h5 q-mt-sm q-mb-xs text-center text-weight-bold">Medical and Dental Checkup</div>
          <text-body2>Sept. 09, 2023 (Monday)<br>7:30 PM</text-body2>
        </q-card-actions>
      </q-card>
    </div>

    <div class="q-pa-md row items-start q-gutter-md col-12 col-md-4 three justify-center">
      <q-timeline color="green">
        <q-timeline-entry heading body="Upcoming Events" />

        <q-timeline-entry title="Christmas Party" subtitle="December 22, 2023" icon="celebration" :body="body" />

        <q-timeline-entry title="Fun Run" subtitle="January 22, 2024" icon="directions_run" :body="body" />

        <q-timeline-entry title="Love Month" subtitle="February 15, 2024" icon="favorite" :body="body" />

      </q-timeline>
    </div>
  </div>
</template>

<script>
export default {
  setup() {
    return {
      lorem: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
      body: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
    }
  }
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 350px
.text-h5
  white-space: nowrap
  overflow: hidden
  text-overflow: ellipsis
  max-width: 100%
</style>
