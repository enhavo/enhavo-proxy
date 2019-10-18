import Application from "@enhavo/app/Form/FormApplication";
import ActionRegistryPackage from './registry/action';
import ModalRegistryPackage from './registry/modal';
import FormRegistryPackage from './registry/form';
import Message from '@enhavo/app/FlashMessage/Message';
import * as $ from 'jquery';

Application.getActionRegistry().registerPackage(new ActionRegistryPackage(Application));
Application.getModalRegistry().registerPackage(new ModalRegistryPackage(Application));
Application.getFormRegistry().registerPackage(new FormRegistryPackage(Application));
Application.getForm().load();
Application.getVueLoader().load(() => import("@enhavo/app/Form/Components/FormComponent.vue"));

$(document).on('renewcertificate', (event: Event) => {

    let id = Application.getDataLoader().load().resource.id;
    let url = Application.getRouter().generate('app_host_renewcertificate', {id: id});


    Application.getView().loading();
    $.ajax({
        type: "POST",
        url: url,
        success: function (result:any) {
            $('[data-form-certificate]').val(result.certificate);
            Application.getView().loaded();
            Application.getFlashMessenger().addMessage(new Message(Message.SUCCESS, 'Certificate updated successfully'));
        },
        error: function () {
            Application.getView().loaded();
            Application.getFlashMessenger().addMessage(new Message(Message.ERROR, 'Unable to renew certificate'));
        }
    });

});