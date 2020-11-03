<template>
    <div class="bg-pink" v-if="!load">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <transition :name="displaySmall ? 'slide-out-in-reverse' : 'slide-out-in'" mode="out-in">
                <div v-if="displaySmall">
                    <card-small v-for="(n, index) in display"
                        :key="'card ' + index"
                        :card="cards[index]"
                        :index="index"
                        :displaySmall="displaySmall"
                        @displayChange="displayChange"
                        >
                    </card-small>
                </div>
                <detail-card key="3" v-else class="detail-card" @closeWindow="closeWindow" :card="card" :pictures="pictures"></detail-card>
            </transition>
        </div>
        <div :class="displayCircle ? 'opacity-1' : ''" v-if="display < cards.length" class="circle align-center"> 
            <img @click="moreCard" src="/img/svg/more.svg" alt="Voir deux élements de plus">
        </div>
        <br v-else>
    </div>
</template>

<script>
import CardSmall from '../shares/CardSmall';
import DetailCard from '../shares/DetailCard';

export default {
    components: {
        CardSmall,
        DetailCard
    },
    data() {
        return {
            load: true,
            cards: null,
            display: 0,
            displaySmall: true,
            displayCircle: false,
            card: null,
            pictures: null,
        }
    },
    methods : {
        moreCard(){
            if(this.display < this.cards.length){
                this.display +=1;
            }
            if(this.display < this.cards.length){
                setTimeout(() => {
                    this.display +=1;
                }, 500);
            }
        },
        displayChange(value){
            this.card = value.card;
            this.pictures = value.pictures;
            this.displaySmall = false;
        },
        closeWindow() {
            this.pictures = null;
            this.card = null;
            this.displaySmall = true;
        },
    },
    watch : {
        displaySmall(value){
            if(value) {
                setTimeout(() => {
                    this.displayCircle = true;
                }, 1100);
            }else {
                this.displayCircle = false;
            }
        }
    },
    created() {
        axios.get('/api/get/card/all').then((response) => {
            this.cards = response.data.cards;
            this.display = 2;
            this.load = false;
            this.displayCircle = true;

        });
    },
}
</script>

<style scoped>
.full-margin {
    margin-top: 15vh;
}

.circle {
    transition: all 200ms linear;
    opacity: 0;
}

.opacity-1 {
    opacity: 1;
}

img {
    width: 20%;
}

.detail-card {
    position: absolute;
    top: 0;
    left: 0;
}
</style>