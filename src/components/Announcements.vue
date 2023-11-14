<template>
  <div class="centered-card">
    <q-card class="my-card" style="width: 1200px;">
      <q-card-section>
        <div class="text-h3 text-center">Announcements</div>
      </q-card-section>

      <q-separator />

      <q-card-section class="q-pt-none">
        <q-select
          v-model="selectedMonth"
          :options="months"
          label="Filter by Month"
          outlined
        ></q-select>
        <q-select
          v-model="selectedYear"
          :options="years"
          label="Filter by Year"
          outlined
        ></q-select>

        <q-scroll-area style="height: 570px;">
          <q-timeline>
            <q-timeline-entry
              v-for="announcement in filteredAnnouncements" 
              :key="announcement.id"
              :title="announcement.title"
              :subtitle="announcement.date"
            >
              {{ announcement.description }}
            </q-timeline-entry>
          </q-timeline>
        </q-scroll-area>
      </q-card-section>
    </q-card> 
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectedMonth: '',
      selectedYear: '',
      announcements: [
        {
          id: 1,  
          title: 'Site Maintenance',
          date: 'January 1, 2020',
          description: 'The site will be undergoing maintenance between 3-5pm PST.'
        },
        {
          id: 2,
          title: 'New Feature Release', 
          date: 'January 15, 2020',
          description: 'We have released a new feature for analytics reporting. See the documentation for more details.'
        },
        {
          id: 3,
          title: 'Service Disruption',
          date: 'January 28, 2020',
          description: 'There will be intermittent service disruptions between 2-4am PST due to network upgrades.'
        },
        {
          id: 1,  
          title: 'Site Maintenance',
          date: 'January 1, 2020',
          description: 'The site will be undergoing maintenance between 3-5pm PST.'
        },
        {
          id: 2,
          title: 'New Feature Release', 
          date: 'January 15, 2020',
          description: 'We have released a new feature for analytics reporting. See the documentation for more details.'
        },
        {
          id: 3,
          title: 'Service Disruption',
          date: 'January 28, 2020',
          description: 'There will be intermittent service disruptions between 2-4am PST due to network upgrades.'
        },
        {
          id: 4,
          title: 'App Update',
          date: 'February 5, 2020',
          description: 'A new version of the app has been released. Please update for the latest features and bug fixes.'
        },
        {  
          id: 5,
          title: 'Billing Reminder',
          date: 'February 15, 2020', 
          description: 'This is a reminder that yearly billing will be charged on March 1st. Please update your payment information.'
        },
        {
          id: 6,
          title: 'Server Migration',
          date: 'March 10, 2020',
          description: 'Our servers will be undergoing migration March 15-17. Minimal downtime is expected.'
        },
        {
          id: 7,
          title: 'Holiday Hours',
          date: 'April 1, 2020',
          description: 'Support will be limited December 23-25 and December 31 - January 2 for the holidays.'
        },
        {
          id: 8, 
          title: 'Password Reset',
          date: 'May 5, 2020',
          description: 'If you have forgotten your password, you can reset it here. A reset link will be emailed.'
        },
        {
          id: 9,
          title: '2FA Changes',
          date: 'June 20, 2020',
          description: 'Two-factor authentication (2FA) methods have been updated. Review the security page for more information.'
        }
        ]
    };
  },
  computed: {
    months() {
      return [
        { label: 'January', value: 'January' },
        { label: 'February', value: 'February' },
        { label: 'March', value: 'March' },
        { label: 'April', value: 'April' },
        { label: 'May', value: 'May' },
        { label: 'June', value: 'June' },
        { label: 'July', value: 'July' },
        { label: 'August', value: 'August' },
        { label: 'September', value: 'September' },
        { label: 'October', value: 'October' },
        { label: 'November', value: 'November' },
        { label: 'December', value: 'December' },
        ];
    },
    years() {
      const currentYear = new Date().getFullYear();
      return Array.from({ length: 10 }, (_, index) => currentYear - index);
    },
    filteredAnnouncements() {
      return this.announcements.filter(announcement => {
        const announcementDate = new Date(announcement.date);
        const selectedMonth = this.selectedMonth ? String(this.selectedMonth).toLowerCase() : '';
        const selectedYear = this.selectedYear ? parseInt(this.selectedYear) : 0;

        const matchesMonth = !selectedMonth || announcementDate.toLocaleString('default', { month: 'long' }).toLowerCase() === selectedMonth;
        const matchesYear = !selectedYear || announcementDate.getFullYear() === selectedYear;

        return matchesMonth && matchesYear;
      });
    },
  },
};
</script>

<style scoped>
.centered-card {
  display: flex;
  justify-content: center;
  align-items: center; 
}

.my-card {
  max-width: 1200px;
  margin: 0 auto; 
}

.q-card {
  /* background: linear-gradient(to right, #273430, #185a9d);  */
}
</style>