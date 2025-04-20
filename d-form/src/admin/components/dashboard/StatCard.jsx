import React, { useEffect, useState } from 'react';

function StatCard({ title, count, bgColor }) {
  const [currentCount, setCurrentCount] = useState(0);
  useEffect(()=>{
    if(currentCount<count)
    {
      setTimeout(()=>{
        setCurrentCount(currentCount+1);
      }, 20)
    }
  }, [count, currentCount])
  return (
    <div className={`${bgColor} text-white rounded-lg p-8 flex flex-col items-center justify-center`}>
      <h3 className="text-xl mb-4">{title}</h3>
      <p className="text-5xl font-bold">{currentCount}</p>
    </div>
  );
}

export default StatCard;