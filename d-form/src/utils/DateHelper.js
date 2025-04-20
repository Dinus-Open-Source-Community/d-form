import {format} from "date-fns";
export const formatRangedDate=(date1, date2)=>{
    const year1 = format(new Date(date1), "y");
    const year2 = format(new Date(date1), "y");
    const month1 = format(new Date(date1), "MMMM");
    const month2 = format(new Date(date2), "MMMM");
    const day1 = format(new Date(date1), "cccc dd");
    const day2 = format(new Date(date2), "cccc dd");

    const days = day1+" - "+day2;
    const months_part1 = (month1!==month2||year1!==year2 ? month1 : "");
    const months_part2 = (year1!==year2 ? " "+year2 : "");
    const months_part3 = ((months_part1+months_part2)!==""?" - ":"");
    const months_parts = months_part1+months_part2+months_part3;
    
    const months = months_parts+month2+" "+year2;

    return {days, months}
}
