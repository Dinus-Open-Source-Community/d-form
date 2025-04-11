import React from 'react';

function Button({ text, className }) {
  return (
    <button className={`px-4 py-2 rounded-lg ${className}`}>
      {text}
    </button>
  );
}

export default Button;