import AuthController from './AuthController'
import PageController from './PageController'
import ChatController from './ChatController'
const Controllers = {
    AuthController: Object.assign(AuthController, AuthController),
PageController: Object.assign(PageController, PageController),
ChatController: Object.assign(ChatController, ChatController),
}

export default Controllers