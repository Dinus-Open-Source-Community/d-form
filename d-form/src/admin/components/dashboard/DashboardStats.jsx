import React from 'react';
import StatCard from './StatCard';

function DashboardStats() {
  return (
    <div className="grid grid-cols-3 gap-3 px-10 pb-10">
      <StatCard 
        title="Ongoing Events"
        count={2}
        bgColor="bg-[#343434]"
      />
      <StatCard 
        title="Upcomming Events"
        count={5}
        bgColor="bg-[#343434]"
      />
      <StatCard 
        title="Events Completed"
        count={3}
        bgColor="bg-[#343434]"
      />
    </div>
  );
}

export default DashboardStats;