import { useEffect, useRef } from 'react'

/**
 * Basically, a useEffect implementation, that doesn't run on first render.
 * @param {Function} func Function that will be called.
 *  @param {Array} deps array of dependencies.
 */
export default function useDidUpdateEffect(func, deps) {
    const didMount = useRef(false)

    useEffect(() => {
        if(didMount.current) func()
        else didMount.current = true;
    }, deps)
}