import React from 'react';

function Badge({ text, color }) {
  return (
    <span className={`${color} text-white text-xs px-3 py-1 rounded-full`}>
      {text}
    </span>
  );
}

export default Badge;