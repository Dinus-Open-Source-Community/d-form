import React, { useState, useEffect } from 'react';
import StatCard from './StatCard';

function DashboardStats() {
  const [countOngoing, setCountOngoing] = useState(0);
  const [countCompleted, setCountCompleted] = useState(0);
  const [countUpcoming, setCountUpcoming] = useState(0);

  const fetchStats=async(timestamp, setCount)=>{
    const baseURL = import.meta.env.VITE_API_URL;
    const apiURL = `${baseURL}/events/count/${timestamp}`

    const response = await fetch(apiURL, {
      mode: "cors",
      method: "GET",
      headers: {"Content-Type": "application/json"}
    });
    let result;
    switch(response.status)
    {
      case 200 :
        result = await response.json();
        setCount(result.data);
        break;
    }
  }
  useEffect(()=>{
    fetchStats("ongoing", setCountOngoing);
    fetchStats("completed", setCountCompleted);
    fetchStats("upcoming", setCountUpcoming);
  }, [])
  return (
    <div className="grid grid-cols-3 gap-3 px-10 pb-10">
      <StatCard 
        title="Ongoing Events"
        count={countOngoing}
        bgColor="bg-[#343434]"
      />
      <StatCard 
        title="Upcomming Events"
        count={countUpcoming}
        bgColor="bg-[#343434]"
      />
      <StatCard 
        title="Events Completed"
        count={countCompleted}
        bgColor="bg-[#343434]"
      />
    </div>
  );
}

export default DashboardStats;