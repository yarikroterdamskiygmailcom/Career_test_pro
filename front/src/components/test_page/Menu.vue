<template>
    <div class="item_question nav_step borders d-flex justify-content-between position-relative"
        :style="{width: width}">
        <!--{{step}}{{mobile_arr}}-->
        <div class="arrow arrow_back" v-if="screen == 'mobile'" @click="toggle('back')"></div>
        <div class="arrow arrow_next" v-if="screen == 'mobile'" @click="toggle('next')"></div>
        <router-link v-for="item in mobile_arr"
                     v-if="screen == 'mobile'" :key="item + 'rout'"
                     class="stepped d-flex justify-content-center"
                     :to="`/tests/${item}/1`">{{item}}</router-link>
        <router-link v-if="screen != 'mobile'" v-for="item in menu_array"
                     :key="item + 'rout'"
                     class="stepped d-flex justify-content-center"
                     :to="`/tests/${item}/1`">{{item}}</router-link>
        <div v-if="screen == 'desktop'">
            <div v-for="item in  menu_padding" :key="item + 'for' + 'desk'" :class="`s${item}`"
                 v-if="item == step"
                 class="position-absolute item_question nav_step borders orange_style">
            </div>
        </div>
        <div v-if="screen == 'tablet'" class="tablet">
            <div v-for="item in  menu_padding" :key="item + 'for' + 'tabl' " :class="`s${item}`"
                 v-if="step < 6 ? item == step : item == step - 5"
                 class="position-absolute item_question nav_step borders orange_style">
            </div>
        </div>
        <div v-if="screen == 'mobile'" class="mobile" >
            <div v-for="(item, index) in  menu_padding" :key="item + 'for' + 'tabl' + index " :class="`s${item}`"
                 v-if="active_step(index+1) ?
                       width_active(item):
                       false"
                 class="position-absolute item_question nav_step borders orange_style">
            </div>
        </div>
        <info v-if="screen != 'mobile'" class="info position-absolute" :active="step"></info>
    </div>
</template>

<script>
    import Info from "./Info";

    export default {
        props: ['menu_array', 'menu_padding', 'step', 'width', 'screen'],
        components: {
            info:  Info,
        },
        data(){
            return{
                base: [Number(this.step), Number(this.step) + 1],
                mobile_arr: [Number(this.step), Number(this.step) + 1]
            }
        },
        computed:{
            // mobile_arr:{
            //     set(value){
            //         console.log(value, this.arr)
            //         this.arr = value;
            //     },
            //     get(){
            //         return this.arr;
            //     }
            // }
        },
        methods:{
            toggle(type){
                if(this.mobile_arr[0] <= 1 && type == 'back') return;
                if(this.mobile_arr[0] >= 9 && type == 'next') return;
                this.mobile_arr = type == 'next' ?
                    this.mobile_arr.map(item => item + 2) :
                    this.mobile_arr.map(item => item - 2)
            },
            active_step(){
                return this.mobile_arr.some(item => item <= Number(this.step))
            },
            width_active(index){
                return this.mobile_arr.every(item => item <= Number(this.step)) ?  index == 2 : index == 1
            }
        },
        watch:{
            '$route' (to, from) {
                let step = Number(this.step);
                let to_ = to.params.steps;
                let from_ = from.params.steps;
                this.mobile_arr =  this.mobile_arr.some(item => item == step) ?
                    this.mobile_arr :
                    from_ > to_?  [step - 1, step] : [step, step + 1]
            }
        },
    }
</script>

<style scoped>
    .item_question{
        margin-bottom: 30px;
    }
    .borders{
        border: 1px solid #DFDFDF;
        box-sizing: border-box;
        border-radius: 30px;
        cursor: pointer;
    }
    .nav_step{
        width: 890px;
        margin-bottom: 25px;
    //padding: 18px 36px;
        font-weight: 600;
        line-height: normal;
        font-size: 20px;
    //box-shadow: 0px 3px 7px rgba(0, 0, 0, 0.2);
    }
    .stepped{
        z-index: 10;
        padding: 18px 0;
        width: 89px;
        border-radius: 30px;
    }

    a{
        color: black;
    }
    .s1{
        width: 88.6px;
    }
    .s2{
        width: 177.2px;
    }
    .s3{
        width: 265.5px;
    }
    .s4{
        width: 354.4px;
    }
    .s5{
        width: 443px;
    }
    .s6{
        width: 531.6px;
    }
    .s7{
        width: 620.2px;
    }
    .s8{
        width: 708.8px;
    }
    .s9{
        width: 800px;
    }
    .s10{
        width: 890px;
    }
    .orange_style{
        left: 0;
        top: -1px;
        border: 2px solid #F9892E;
        padding: 29px 0;
        margin: 0;
        box-shadow: 0px 3px 7px rgba(0, 0, 0, 0.18);
    }
    .arrow{
        width: 12px;
        height: 27px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        position: absolute;
        top:19px
    }
    .arrow_back{
        background-image: url("http://backcartestpro.qbex.io/assets/arrow/no_active_arrow.svg");
        left: -42px;
    }
    .arrow_back:hover{
        background-image: url("http://backcartestpro.qbex.io/assets/arrow/active_arrow.svg");
        transform: rotate(-180deg);
    }
    .arrow_next{
        background-image: url("http://backcartestpro.qbex.io/assets/arrow/no_active_arrow.svg");
        transform: rotate(-180deg);
        right: -42px;
    }
    .arrow_next:hover{
        background-image: url("http://backcartestpro.qbex.io/assets/arrow/active_arrow.svg");
        transform: rotate(0deg);
    }
</style>
