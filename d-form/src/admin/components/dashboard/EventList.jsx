import React, { useEffect, useState } from "react";
import EventCard from "./EventCard";
import { events } from "../../data/events";
import BonesLoader from "../common/BonesLoader";
import NotFound from "../common/Error";

const todayEvent = events[0];
const ongoingEvents = events.slice(1, 4);
const upcomingEvents = events.slice(1, 3);


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
    setCode(response.status);
}
// REMOVE 3 EVENT'S COMPONENT
/* 
Since it can be simplified with single component, I remove them for now and change it
to EventCatalogue component. 
If there would be some specific features for each type of events, consider to
separate them again.
Author : Felix
*/
const EventsCatalogue=(({showSeeAll, title, timestamp, useQR=false}) => {
  const [error, setError] = useState(false);
  const [data, setData] = useState([]);
  const [code, setCode] = useState(200);

  useEffect(()=>{fetchEvents(timestamp, setData, setError, setCode)}, []);
  return (
    <section className="mb-8">
      <div className="flex justify-between items-center mb-3 sm:mb-5">
        <div className="flex items-center">
          <h2 className="text-lg sm:text-1xl text-[#343434] font-medium mr-3">
            {title}
          </h2>
          {showSeeAll && (
            <button className="text-sm text-white bg-[#343434] px-3 py-1 rounded-lg">
              See All
              <span className="border border-white bg-white text-black ml-2 px-2 py-0 rounded-md">
                {1}
              </span>
            </button>
          )}
        </div>
      </div>

      {((error && code===404) && !data?.length) && (
        <NotFound />
      )}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mt-4 gap-4">
        
        {(!error && !data?.length) && (
          <BonesLoader n={3} />
        )}
        {(!error && data?.length) && (data.map((event) => (
          <EventCard key={event.id} event={event} id={event.id} />
        )))}
      {/* Fungsi untuk scan qr dan details */} 
        {useQR && (
          <div className="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer">
            <div className="h-36 sm:h-40 md:h-48 bg-[#343434]"></div>
            <div className="p-3 sm:p-8 items-center">
              <div className="flex flex-wrap gap-2 justify-center">
                <button className="bg-[#343434] text-white px-4 py-2 rounded-lg mx-1 border-2 border-gray-400 transition-transform transform hover:scale-105 hover:bg-black/10 hover:text-black">
                  Scan QR
                </button>
                <button className="bg-white text-[#343434] px-4 py-2 rounded-lg mx-1 border-2 border-gray-400 transition-transform transform hover:scale-105 hover:bg-gray-200">
                  Details
                </button>
              </div>
            </div>
          </div>
        )}
      </div>
    </section>
  )
})



const EventList = ({
  showToday = false, // Ensure this is set to false to hide today's event
  showOngoing = true,
  showUpcoming = true,
  showSeeAll = true,
}) => {
  
  return (
    <div className="space-y-8">
      {/* {showToday && <TodayEvent showSeeAll={showSeeAll} />}
      {showOngoing && <OngoingEvents showSeeAll={showSeeAll} />}
      {showUpcoming && <UpcomingEvents showSeeAll={showSeeAll} />} */}
      {showToday && <EventsCatalogue showSeeAll={showSeeAll} title={"Today's Events"} timestamp="today" useQR={true}/>}
      {showOngoing && <EventsCatalogue showSeeAll={showSeeAll} title={"Ongoing Events"} timestamp="ongoing" useQR={false}/>}
      {showUpcoming && <EventsCatalogue showSeeAll={showSeeAll} title={"Upcoming Events"} useQR={false} />}
    </div>
  );
};

export default EventList;
