import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\ChatController::send
 * @see app/Http/Controllers/ChatController.php:25
 * @route '/chat/messages'
 */
export const send = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: send.url(options),
    method: 'post',
})

send.definition = {
    methods: ["post"],
    url: '/chat/messages',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\ChatController::send
 * @see app/Http/Controllers/ChatController.php:25
 * @route '/chat/messages'
 */
send.url = (options?: RouteQueryOptions) => {
    return send.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ChatController::send
 * @see app/Http/Controllers/ChatController.php:25
 * @route '/chat/messages'
 */
send.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: send.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\ChatController::send
 * @see app/Http/Controllers/ChatController.php:25
 * @route '/chat/messages'
 */
    const sendForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: send.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\ChatController::send
 * @see app/Http/Controllers/ChatController.php:25
 * @route '/chat/messages'
 */
        sendForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: send.url(options),
            method: 'post',
        })
    
    send.form = sendForm
/**
* @see \App\Http\Controllers\ChatController::clear
 * @see app/Http/Controllers/ChatController.php:53
 * @route '/chat/messages'
 */
export const clear = (options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: clear.url(options),
    method: 'delete',
})

clear.definition = {
    methods: ["delete"],
    url: '/chat/messages',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\ChatController::clear
 * @see app/Http/Controllers/ChatController.php:53
 * @route '/chat/messages'
 */
clear.url = (options?: RouteQueryOptions) => {
    return clear.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ChatController::clear
 * @see app/Http/Controllers/ChatController.php:53
 * @route '/chat/messages'
 */
clear.delete = (options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: clear.url(options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\ChatController::clear
 * @see app/Http/Controllers/ChatController.php:53
 * @route '/chat/messages'
 */
    const clearForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: clear.url({
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\ChatController::clear
 * @see app/Http/Controllers/ChatController.php:53
 * @route '/chat/messages'
 */
        clearForm.delete = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: clear.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    clear.form = clearForm
const chat = {
    send: Object.assign(send, send),
clear: Object.assign(clear, clear),
}

export default chat