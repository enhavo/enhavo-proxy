import RegistryPackage from "@enhavo/app/Form/RegistryPackage";
import ApplicationInterface from "@enhavo/app/ApplicationInterface";
import FormFormRegistryPackage from "@enhavo/form/FormRegistryPackage";

export default class FormRegistryPackage extends RegistryPackage
{
    constructor(application: ApplicationInterface) {
        super();
        this.registerPackage(new FormFormRegistryPackage(application));
    }
}