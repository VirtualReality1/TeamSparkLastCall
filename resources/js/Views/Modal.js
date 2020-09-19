import React from 'react';

const Modal = (props) => {
    return (
        <div className={'fixed w-full h-full top-0 left-0 flex items-center justify-center'}>
            <div className={'absolute w-full h-full bg-gray-900 opacity-50'} onClick={props.hide}/>
            <div className={'w-1/2 max-h-full bg-white border-4 border-secondary my-16 overflow-scroll z-50 shadow-lg'}>
                <button className={'absolute px-4 py-3 focus:outline-none'} onClick={props.hide}>
                    X
                </button>
                {props.children}
            </div>
        </div>
    );
};

export default Modal;
