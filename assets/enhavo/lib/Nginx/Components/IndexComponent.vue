<template>
    <div class="app-view">
        <view-view v-bind:data="view"></view-view>
        <flash-messages v-bind:messages="messages"></flash-messages>
        <modal-component v-bind:data="modals"></modal-component>
        <action-bar v-bind:primary="actions"></action-bar>
    </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import ActionBar from "@enhavo/app/Action/Components/ActionBar.vue";
import '@enhavo/app/assets/styles/view.scss'
import ViewData from "@enhavo/app/View/ViewData";
import ViewComponent from "@enhavo/app/View/Components/ViewComponent";
import FlashMessages from "@enhavo/app/FlashMessage/Components/FlashMessages.vue";
import ModalComponent from "@enhavo/app/Modal/Components/ModalComponent.vue";

@Component({
    components: {ModalComponent, FlashMessages, ActionBar, 'view-view': ViewComponent}
})
export default class IndexComponent extends Vue {
    @Prop()
    messages: Array<object>;

    @Prop()
    view: ViewData;

    @Prop()
    actions: Array<object>;

    @Prop()
    modals: Array<object>;
}
</script>


