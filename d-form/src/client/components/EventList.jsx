// import BonesCard from "../../admin/components/common/BonesCard";
import BonesLoader from "../../admin/components/common/BonesLoader";
import NotFound from "../../admin/components/common/Error";
import EventCard from "./EventCard";
import {useEffect, useState} from 'react';


const events = [
  { 
    id: 1,
    category: ["RKT", "Programming"], 
    title: "Open Source on The School", 
    date: "21 - 24 October 2024"
  },
  { 
    id: 2,
    category: ["RKT", "Programming"], 
    title: "Open Source on The School", 
    date: "21 - 24 October 2024"
  },
  { 
    id: 3,
    category: ["NON-RKT", "Networking"], 
    title: "DOSCOM SHARING TIME: Docker", 
    date: "21 October 2024"
  },
  { 
    id: 4,
    category: ["NON-RKT", "Networking"], 
    title: "DOSCOM SHARING TIME: Docker", 
    date: "21 October 2024"
  },
  { 
    id: 5,
    category: ["NON-RKT", "Networking"], 
    title: "DOSCOM SHARING TIME: Docker", 
    date: "21 October 2024"
  },
];

const todayEvents = events.slice(0, 2); 
const upcomingEvents = events.slice(1); 

const fetchEvents = async (timestamp, setData, setError, setCode)=>{
  const eventPerPage = 3;
  const baseURL = import.meta.env.VITE_API_URL;
  const apiURL = `${baseURL}/events?timestamp=${timestamp}&per_page=${eventPerPage}`;

  const response = await fetch(apiURL, {
    mode: 'cors',
    method: 'GET', 
    headers: {'Content-Type': 'application/json'}
  });
  let result;
  switch(response.status)
  {
    case(200) :
      result = await response.json();
      setError(false);
      setData(result.data);
      break;
    case 404 :
      setError(true);
      setData([]);
      break;
  }
  setCode(response.status)
}
// REMOVE 3 EVENT'S COMPONENT
/* 
Since it can be simplified with single component, I remove them for now and change it
to EventCatalogue component. 
If there would be some specific features for each type of events, consider to
separate them again.
Author : Felix
*/
const EventsCatalogue = ({ onEventClick, title, timestamp }) => {
  const [data, setData] = useState([]);
  const [error, setError] = useState(false);
  const [code, setCode] = useState(200);

  useEffect(()=>{fetchEvents(timestamp, setData, setError, setCode)},[]);
  return (
    <section className="mb-6 sm:mb-8">
      <h2 className="text-lg sm:text-1xl text-[#343434] mb-3 sm:mb-5 font-medium">{title}</h2>
      {((error && code===404) && !data?.length) && (
        <NotFound />
      )}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        
        {(!error && !data?.length) && (
          <BonesLoader n={3} />
        )}
        {(!error && data?.length) && (data.map((event) => (
          <EventCard key={event.id} id={event.id} event={event} onEventClick={onEventClick} />
        )))}
      </div>
    </section>
  )
};

// const TodayEvent = ({ onEventClick }) => (
//   <section className="mb-6 sm:mb-8">
//     <h2 className="text-lg sm:text-1xl text-[#343434] mb-3 sm:mb-5 font-medium">Today's Events</h2>
//     <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
//       {todayEvents.map((event) => (
//         <EventCard key={event.id} {...event} onEventClick={onEventClick} />
//       ))}
//     </div>
//   </section>
// );

// const UpcomingEvents = ({ onEventClick }) => (
//   <section>
//     <h2 className="text-lg sm:text-1xl text-[#343434] mb-3 sm:mb-5 font-medium">Upcoming Events</h2>
//     <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
//       {upcomingEvents.map((event) => (
//         <EventCard key={event.id} {...event} onEventClick={onEventClick} />
//       ))}
//     </div>
//   </section>
// );

const EventList = ({ showToday = true, onEventClick }) => {
  return (
    <div className="py-6 sm:py-8 px-4 sm:px-8 md:px-12">
      {showToday && <EventsCatalogue onEventClick={onEventClick} title="Today's Event" timestamp="today" />}
      <EventsCatalogue onEventClick={onEventClick} title="Upcoming Event" timestamp="upcoming" />
    </div>
  );
};

export default EventList;