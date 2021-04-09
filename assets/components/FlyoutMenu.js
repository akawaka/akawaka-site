import React, {useState} from 'react'
import { Transition } from '@headlessui/react'

export default function(props) {
  const [isOpen, setIsOpen] = useState(false)

  return (
    <>
      <button type="button"
              onClick={() => setIsOpen(!isOpen)}
              className={`${isOpen ? 'text-gray-600' : 'text-gray-400'} text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500`}
              aria-expanded={isOpen}>
        <span>{ props.menu.name }</span>

        <svg className="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500"
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
             fill="currentColor" aria-hidden="true">
          <path fillRule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clipRule="evenodd"/>
        </svg>
      </button>

      <Transition
        show={isOpen}
        as={React.Fragment}
        enter="transition ease-out duration-200"
        enterFrom="opacity-0 -translate-y-1"
        enterTo="opacity-100 translate-y-0"
        leave="transition ease-in duration-150"
        leaveFrom="opacity-100 translate-y-0"
        leaveTo="opacity-0 -translate-y-1"
      >
        {(ref) => (
          <div
            ref={ref}
            className="absolute z-10 left-1/2 transform -translate-x-1/2 mt-3 px-2 w-screen max-w-md sm:px-0">
            <div
              className="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
              <div
                className="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                { props.menu.items.map((value, index) => {
                  return <a href="#"
                     className="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50 transition ease-in-out duration-150">

                    <svg
                      className="flex-shrink-0 h-6 w-6 text-indigo-600"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d={ value.icon }></path>
                    </svg>'

                    <div className="ml-4">
                      <p className="text-base font-medium text-gray-900">
                        { value.name }
                      </p>
                      <p className="mt-1 text-sm text-gray-500">
                        { value.text }
                      </p>
                    </div>
                  </a>
                }) }
              </div>

              <div
                className="px-5 py-5 bg-gray-50 space-y-6 sm:flex sm:space-y-0 sm:space-x-10 sm:px-8">
                { props.menu.items.map((value, index) => {
                  return <div className="flow-root">
                    <a href="#"
                       className="-m-3 p-3 flex items-center rounded-md text-base font-medium text-gray-900 hover:bg-gray-100 transition ease-in-out duration-150">
                      <svg className="flex-shrink-0 h-6 w-6 text-gray-400"
                           xmlns="http://www.w3.org/2000/svg" fill="none"
                           viewBox="0 0 24 24" stroke="currentColor"
                           aria-hidden="true">
                        <path strokeLinecap="round" strokeLinejoin="round"
                              strokeWidth="2"
                              d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path strokeLinecap="round" strokeLinejoin="round"
                              strokeWidth="2"
                              d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                      </svg>
                      <span className="ml-3">{ value.name }</span>
                    </a>
                  </div>
                }) }
              </div>
            </div>
          </div>
        )}
      </Transition>
    </>
  )
}
