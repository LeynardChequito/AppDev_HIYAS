<template>
    <div>
        <q-btn @click="toggleButton(1)" :class="{ 'clicked': buttonClicked1 }" :label="buttonLabel1" ref="button1" />
        <q-btn @click="toggleButton(2)" :class="{ 'clicked': buttonClicked2 }" :label="buttonLabel2" ref="button2" />
        <q-card v-if="buttonClicked1 || buttonClicked2" class="my-card">
            <q-card-section>
                <q-list>
                    <q-item v-for="(item, index) in (buttonClicked1 ? items1 : items2)" :key="index" clickable
                        @click="handleItemClick(item)">
                        <q-item-section>
                            {{ item }}
                        </q-item-section>
                    </q-item>
                </q-list>
            </q-card-section>
        </q-card>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            buttonClicked1: false,
            buttonClicked2: false,
            buttonLabel1: 'Toggle Card 1',
            buttonLabel2: 'Toggle Card 2',
            items1: ['Item 1', 'Item 2', 'Item 3'], // List for button 1
            items2: ['Item A', 'Item B', 'Item C'], // List for button 2
        };
    },
    methods: {
        toggleButton(buttonNumber) {
            if (buttonNumber === 1) {
                this.buttonClicked1 = !this.buttonClicked1;
                this.buttonClicked2 = false;
            } else if (buttonNumber === 2) {
                this.buttonClicked2 = !this.buttonClicked2;
                this.buttonClicked1 = false;
            }
            this.updateClickOutsideHandler();
        },
        updateClickOutsideHandler() {
            if (this.buttonClicked1 || this.buttonClicked2) {
                document.addEventListener('click', this.clickOutsideHandler);
            } else {
                document.removeEventListener('click', this.clickOutsideHandler);
            }
        },
        clickOutsideHandler(event) {
            if (this.$refs.button1 && this.$refs.button2) {
                const buttonRect1 = this.$refs.button1.$el.getBoundingClientRect();
                const buttonRect2 = this.$refs.button2.$el.getBoundingClientRect();
                const isClickInsideButton1 = (
                    event.clientX >= buttonRect1.left &&
                    event.clientX <= buttonRect1.right &&
                    event.clientY >= buttonRect1.top &&
                    event.clientY <= buttonRect1.bottom
                );
                const isClickInsideButton2 = (
                    event.clientX >= buttonRect2.left &&
                    event.clientX <= buttonRect2.right &&
                    event.clientY >= buttonRect2.top &&
                    event.clientY <= buttonRect2.bottom
                );

                if (!isClickInsideButton1 && !isClickInsideButton2) {
                    this.buttonClicked1 = false;
                    this.buttonClicked2 = false;
                    document.removeEventListener('click', this.clickOutsideHandler);
                }
            }
        },
        handleItemClick(item) {
            // Handle item click logic here
            console.log('Clicked:', item);
        },
    },
};
</script>
  
<style scoped>
.clicked {
    background-color: primary;
    /* Change this to your desired "clicked" color */
    color: white;
    /* Text color when the button is "clicked" */
}

.my-card {
    width: 300px;
    /* Adjust the width as needed */
    position: absolute;
    top: 50px;
    /* Adjust the positioning as needed */
}
</style>
  