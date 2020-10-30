<template>
    <div v-if="!load">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <card-small v-for="(card, index) in cards" 
                :key="'card ' + index"
                :card="card">
            </card-small>
        </div>
    </div>
</template>

<script>
import CardSmall from '../shares/CardSmall';

export default {
    components: {
        CardSmall,
    },
    data() {
        return {
            load: true,
            cards: null,
        }
    },
    created() {
        axios.get('/api/get/card/all').then((response) => {
            this.cards = response.data.cards;
            this.load = false;
        });
    }
}
</script>

<style scoped>

</style>