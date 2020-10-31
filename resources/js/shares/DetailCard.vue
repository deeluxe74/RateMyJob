<template>
    <div>
        <div class="frame-illustration">
            <transition name="slide" mode="out-in">
                <img v-if="active === index" v-for="(picture, index) in pictures" class="illustation" :src="pictures[index].url" alt="Illustration de la demande" :key="'picture' + index">
            </transition>
        </div>
        <div class="forme bg-black d-flex flex-row justify-content-between align-items-start">
            <div @click="likeOrDislike('like')" class="d-flex flex-row align-items-center">
                <img src="/img/svg/heart.svg" alt="Nombre de like">
                <div class="ml-1">
                    <transition name="numUp" mode="out-in">
                        <h2 :key="card.like">{{ card.like }}</h2>
                    </transition>
                </div>
            </div>
            <h3 class="align-self-center mt-3">{{ card.like > 0 ? Math.round(card.like / (card.like + card.dislike) * 100) : 0 }}%</h3>
            <div @click="likeOrDislike('dislike')" class="d-flex flex-row align-items-center">
                <img src="/img/svg/heart-empty.svg" alt="Nombre de dislike">
                <div class="ml-1">
                    <transition name="numUp" mode="out-in">
                        <h2 :key="card.dislike">{{ card.dislike }}</h2>
                    </transition>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center">
            <div v-for="(picture, index) in pictures" @click="active = index" :class="isActive(index)" class="circle" :key="'element' + index"></div>
        </div>

        <div class="align-center py-3" v-if="card.description">
            <h2>Description</h2>
            <p class="desc">{{ card.description }}</p>
        </div>

        <div class="d-flex flex-column talk bg-pink-flash p-3">
            <div class="d-flex flex-row align-items-center">
                <img class="mr-2" src="/img/svg/chat.svg" alt="Nombre de commentaire">
                <h4>Commentaires</h4>
            </div>

            <div class="align-self-end message bg-pink px-3 py-2 my-2">
                <h4 class="name">Paul</h4>
                <p>Amazing, i like it. I want more shoot like that !</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['card', 'pictures'],
    data() {
        return {
            active: 0,
        }
    },
    methods: {
        isActive(index) {
            if(index === this.active){
                return 'bg-pink-flash';
            }else {
                return 'bg-white';
            }
        },
        likeOrDislike(isLike) {
            if(isLike === 'like') {
                axios.post('api/set/like', {
                    id: this.card.id,
                }).then((response) => {
                    if(response.data) {
                        this.card.like +=1;
                    }
                })
            }else {
                axios.post('api/set/dislike', {
                    id: this.card.id,
                }).then((response) => {
                    if(response.data) {
                        this.card.dislike +=1;
                    }
                })
            }
        }
    }
}
</script>

<style scoped>
h3 {
    font-size: 2.3rem;
}

h2 {
    font-size: 1.8rem;
}

img {
    width: 3rem;
}

.desc {
    font-size: 1.2rem;
}

.name {
    font-size: 1.8rem;
}

.message {
    border-radius: 15px;
    max-width: 80vw;
    width: max-content;
}

.circle {
    margin: 3vh 2vw;
    width: 11vw;
    height: 11vw;
    border-radius: 50%;
}

.frame-illustration {
    overflow: hidden;
    width: 100vw;
    max-height: 80vh;
}

.illustation {
    position: relative;
    top: 7vh;
    width: 100%;
}

.forme {
    box-shadow: 9px 8px 15px 0px #000000b7;
    width: 100%;
    height: 11vh;
    border-bottom-left-radius: 200px 120%;
    border-bottom-right-radius: 200px 120%;
    padding: 4% 10%;
}

.alert-success {
    border: none;
    color: white;
    width: 70vw;
}

.numUp-leave-to {
    animation: flip-in-ver-left 500ms cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}

@keyframes flip-in-ver-left {
    0% {
        transform: rotateY(0deg);
        filter: blur(0px);
    }
    70% {
        filter: blur(6px);
    }
    100% {
        transform: rotateY(360deg);
        filter: blur(0px);
    }
}
</style>