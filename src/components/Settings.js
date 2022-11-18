import React from 'react';
import { useState, useEffect } from "@wordpress/element";
import apiFetch from '@wordpress/api-fetch';
import Chart from './charts';
import { __ } from '@wordpress/i18n';

const Settings = () => {

    const [ graphTime, setGraphTime ] = useState( '7' );
    
    const [graphData, setGraphData] = useState([]);
    const [currentViewGraphData, setCurrentViewGraphData] = useState([]);

    const url = `${appLocalizer.apiUrl}/wprk/v1/settings`;

    useEffect( () => {
        apiFetch(  { url }  )
        .then( ( res ) => {
            let respData = JSON.parse(res);
            let data = respData.map((e => {
                return {
                    name: e.name,
                    uv: Number(e.uv),
                    pv: Number(e.pv),
                    amt: Number(e.amt)
                  }
            }));

            setGraphData(data)

            setCurrentViewGraphData(data.slice(0, 6))
        }, (e) => {
            console.error("REQUEST Error:", e)
        } )
    }, [] )

    const handleGraphTime = (time) => {
        // NOTE: this is only done because there is not enough data in the database. It's for demonstration purposes
        if(time === '15') {
            setCurrentViewGraphData(graphData.slice(0, 10))
        } else if(time === '30') {
            setCurrentViewGraphData(graphData.slice(0))

        } else {
            setCurrentViewGraphData(graphData.slice(0, 6))
        }

        setGraphTime(time)
    }

    return(
        <React.Fragment>
            <div style = {{
                    display: 'flex',
                    flexDirection: 'row',
                    flexFlow: 'wrap',
                    justifyContent: 'space-between',
                    margin: "50px 5%"
                }}>
                    <h2>
                            { __("Graph Widget", "rank-math-graph-widget") }
                    </h2>
                    <div>
                        <select 
                                onChange={(e) => handleGraphTime(e.target.value)}
                                style={{
                                    'float': 'right'
                                }}>
                                    <option value="7">{ __("Last 7 days", "rank-math-graph-widget") }</option>
                                    <option value="15">{ __("Last 15 days", "rank-math-graph-widget") }</option>
                                    <option value="30">{ __("One Month", "rank-math-graph-widget") }</option>
                            </select>
                    </div>
                </div>

            <div style = {{
                display: 'flex',
                flexDirection: 'row',
                flexFlow: 'wrap',
                alignContent: 'center',
                justifyContent: 'center'

            }}>
                <div>
                    {
                        currentViewGraphData.length > 0 ? <Chart data = {currentViewGraphData}/>: null
                    }
                </div>

            </div>
        </React.Fragment>
    )
}

export default Settings;