import React from 'react';

function StatCard({ title, count, bgColor }) {
  return (
    <div className={`${bgColor} text-white rounded-lg p-8 flex flex-col items-center justify-center`}>
      <h3 className="text-xl mb-4">{title}</h3>
      <p className="text-5xl font-bold">{count}</p>
    </div>
  );
}

export default StatCard;