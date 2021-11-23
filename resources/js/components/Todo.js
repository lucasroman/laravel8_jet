import React from 'react';
import ReactDOM from 'react-dom';

function Todo() {
    return <div>Hello World!</div>
}

export default Todo;

ReactDOM.render(
    <Todo />,
    document.getElementById('todoComponent')
);