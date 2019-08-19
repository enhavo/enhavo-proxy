import Application from "@enhavo/app/Index/IndexApplication";
import ActionRegistryPackage from "./registry/action";
import ModalRegistryPackage from "./registry/modal";

Application.getActionRegistry().registerPackage(new ActionRegistryPackage(Application));
Application.getModalRegistry().registerPackage(new ModalRegistryPackage(Application));
Application.getVueLoader().load(() => import("./lib/Nginx/Components/IndexComponent.vue"));