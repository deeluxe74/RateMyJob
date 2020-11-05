<template>
    <div v-if="!load" class="global height-100 bg-pink d-flex flex-column">
        <transition name="appear" mode="out-in" >
            <div v-if="message" :key="message" class="message-error alert alert-info">
                {{ message }}
            </div>
        </transition>
        <div class="frame-illustration bg-pink">
            <img @click="closeWindow" class="close-svg" src="/img/svg/close.svg" alt="Retour a la liste">
            <transition name="slide" mode="out-in">
                <img @click="openPicture(picture)" v-if="active === index" v-for="(picture, index) in pictures" class="illustation pointer" :src="pictures[index].url" alt="Illustration de la demande" :key="'picture' + index">
            </transition>
        </div>
        <div class="forme bg-black d-flex flex-row justify-content-between align-items-start">
            <div @click="likeOrDislike('like')" class="d-flex flex-row align-items-center">
                <img src="/img/svg/heart.svg" alt="Nombre de like">
                <div class="ml-1">
                    <transition name="numUp" mode="out-in">
                        <h2 :key="pictures[active].like">{{ pictures[active].like }}</h2>
                    </transition>
                </div>
            </div>
            <h3 class="align-self-center mt-3">{{ pictures[active].like > 0 ? Math.round(pictures[active].like / (pictures[active].like + pictures[active].dislike) * 100) : 0 }}%</h3>
            <div @click="likeOrDislike('dislike')" class="d-flex flex-row align-items-center">
                <img src="/img/svg/heart-empty.svg" alt="Nombre de dislike">
                <div class="ml-1">
                    <transition name="numUp" mode="out-in">
                        <h2 :key="pictures[active].dislike">{{ pictures[active].dislike }}</h2>
                    </transition>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center">
            <div v-for="(picture, index) in pictures" @click="active = index" :class="isActive(index)" class="hover pointer circle" :key="'element' + index"></div>
        </div>

        <div class="mt-2 author mx-2" v-if="card.description">
            <h2><span class="cl-black">Créateur :</span> {{ card.author }}</h2>
        </div>

        <div class="bloc-desc align-center py-2" v-if="card.description">
            <h2 class="mb-2">Description</h2>
            <p class="desc px-3">{{ card.description }}</p>
        </div>

        <div :class="displayTalk ? 'height-up scroll' : 'hidden'" class="talk bg-pink-flash p-3">
            <div @click="displayTalk = !displayTalk" class="d-flex flex-row align-items-center pointer">
                <img class="mr-2" src="/img/svg/chat.svg" alt="Nombre de commentaire">
                <h4>Commentaires</h4>
            </div>
            <transition name="appear" mode="out-in">
                <div class="d-flex flex-column justify-content-between align-items-end" v-if="displayTalk">
                    <transition-group name="appear" mode="out-in" class="d-flex flex-column align-items-end position-relative w-100">
                        <div v-for="(comment, index) in comments" :key="'comment' + index" class="message bg-pink px-3 py-2 my-2">
                            <h4 class="name">{{ comment.author }}</h4>
                            <p>{{ comment.comment }}</p>
                        </div>
                    </transition-group>

                    <div>
                        <form @submit.prevent="send">
                            <input required v-model="author" placeholder="Pseudo" type="text" class="mt-3 mb-2 align-self-start px-2 bg-pink">
                            <textarea required v-model="comment" placeholder="Votre commentaire ..." class="px-2 bg-pink" rows="3"></textarea>
                            <button type="submit" class="btn btn-info align-self-center">
                                Soumettre
                            </button>
                        </form>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    props: ['card', 'pictures'],
    data() {
        return {
            active: 0,
            displayTalk: false,
            comment: null,
            author: null,
            comments: null,
            load: true,
            message: null,
        }
    },
    methods: {
        ...mapActions({
            userVote: 'userVote',
        }),
        openPicture(picture){
            window.open(picture.url, '_blank');
        },
        isActive(index) {
            if(index === this.active){
                return 'bg-pink-flash';
            }else {
                return 'bg-white';
            }
        },
        likeOrDislike(isLike) {
            const picture = this.pictures[this.active];
            let fund = 0;
            
            this.picturesState.forEach(pictureState => {
                if(pictureState.post_id === picture.post_id && pictureState.url === picture.url){
                    this.message = "Vous avez déja voté pour cette image !";
                    fund = 1;
                    setTimeout(() => {
                        this.message = null;
                    }, 3500);
                }
            });

            if(!fund) {
                if(isLike === 'like') {
                    axios.post('api/set/like', {
                        id: picture.post_id,
                        url: picture.url,
                    }).then((response) => {
                        if(response.data) {
                            this.userVote(picture);
                            picture.like += 1;
                        }
                    })
                }else {
                    axios.post('api/set/dislike', {
                        id: picture.post_id,
                        url: picture.url,
                    }).then((response) => {
                        if(response.data) {
                            this.userVote(picture);
                            picture.dislike += 1;
                        }
                    })
                }
            }
        },
        send() {
            axios.post(`api/set/comment`, {
                id: this.card.id,
                comment: this.comment,
                author: this.author,
            }).then((response) => {
                if(response.data){
                    this.comment = null;
                    this.author= null;
                    this.getComment();
                    this.$emit('commentUp');
                }
            })
        },
        getComment() {
            axios.post(`api/get/comment`, {
                id: this.card.id,
            }).then((response) => {
                this.comments = response.data.comments;
                this.load = false;
            })
        },
        closeWindow() {
            this.$emit('closeWindow', false);
        },
        getCommentsNum() {
            axios.post('/api/get/commentsNum', {
                id: this.card.id
            }).then((response) => {
                this.commentsNum = response.data.commentsNum;
                this.load = false;
            })
        }
    },
    computed: {
        ...mapGetters({
            picturesState : 'pictures',
        })
    },
    created() {
        this.getComment();
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

p {
    font-size: 0.8rem;
}

img {
    width: 3rem;
}

button {
    border: inherit;
    color: white;
}

.global {
    position: relative;
    width: 100%;
    max-width: 480px;
}

.btn {
    font-family: 'Hobo Std', fantasy;
    font-size: 1.3rem
}

.author h2 {
    text-align: left;
    font-size: 1.1rem;
}

.bloc-desc {
    margin-bottom: 8vh;
}

.desc {
    font-size: 1rem;
}

.name {
    font-size: 1.5rem;
}

.message {
    border-radius: 15px;
    max-width: 85%;
    width: max-content;
}

.circle {
    margin: 2vh 2vw;
    width: 11vw;
    height: 11vw;
    border-radius: 50%;
}

.frame-illustration {
    overflow: hidden;
    width: 100%;
    max-height: 80vh;
}

.close-svg {
    transition: opacity 200ms linear;
    position: absolute;
    z-index: 101;
    opacity: 0.6;
    top: 15vh;
    left: 5px;
    width: 3rem;
}.close-svg:hover, .close-svg:focus {
    opacity: 1;
    cursor: pointer;
}

.illustation {
    position: relative;
    top: 7vh;
    height: 40vh;
    min-width: 100%;
    max-width: 120%;
}


.forme {
    box-shadow: 9px 8px 15px 0px #000000b7;
    width: 100%;
    height: 11vh;
    border-bottom-left-radius: 200px 120%;
    border-bottom-right-radius: 200px 120%;
    padding: 4% 10%;
}

.scroll {
    overflow: scroll;
}
.hidden {
    overflow: hidden;
}

.talk {
    width: inherit;
    transition: all 500ms linear;
    bottom: 0;
    height: 4rem;
    position: fixed;
    transform-origin: 0 100%;
}

.height-up {
    box-shadow: -9px -8px 15px 0px #000000b7;
    height: calc(0.9*50% + 0.1*20em);
}

input {
    border: none;
    width: 43%;
    border-radius: 10px;
    height: 2rem;
}

textarea {
    border: none;
    width: 80%;
    border-radius: 15px;
    box-shadow: 0px 3px 3px 3px #0000002d;
}input::placeholder,textarea::placeholder {
    color: white;
    font-size: 1.4rem;
}input:focus, textarea:focus
{   
    color: white;
    outline: none;
    box-shadow: 9px 8px 15px 0px #000000b7;
    transform: scale(1.05);
    transition: all 200ms linear;
}

.message-error {
    position: absolute;
    top: 25vh;
    left: 2vw;
    z-index: 200;
}

.alert-info {
    background-color: red;
    border: none;
    font-size: 1rem;
    color: white;
    width: 60%;
}

.btn-info {
    padding: 0.2rem 0.5rem;
    background-color: #ffffff;
    color: #FF0146;
}

.numUp-leave-to {
    animation: flip-in-ver-left 350ms cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
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