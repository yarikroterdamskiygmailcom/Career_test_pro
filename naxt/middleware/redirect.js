import {RETURN_ROUTER} from "../helper/routerHelp";

export default ({ redirect, route }) => {
    console.log('eeee');
    try {
        const resRout = RETURN_ROUTER.initRouter(route);
        if (resRout) redirect(`final`);
    } catch (e) {
    }
};
