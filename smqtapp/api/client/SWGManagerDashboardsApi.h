/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */

#ifndef _SWG_SWGManagerDashboardsApi_H_
#define _SWG_SWGManagerDashboardsApi_H_

#include "SWGHttpRequest.h"

#include "ModelDashboard.h"
#include "ModelVehicle.h"

#include <QObject>

namespace api {

class SWGManagerDashboardsApi: public QObject {
    Q_OBJECT

public:
    SWGManagerDashboardsApi();
    SWGManagerDashboardsApi(QString host, QString basePath);
    ~SWGManagerDashboardsApi();

    QString host;
    QString basePath;
    QMap<QString, QString> defaultHeaders;

    void managerDashboardGetData();
    void managerDashboardGetVehicles();
    
private:
    void managerDashboardGetDataCallback (HttpRequestWorker * worker);
    void managerDashboardGetVehiclesCallback (HttpRequestWorker * worker);
    
signals:
    void managerDashboardGetDataSignal(ModelDashboard* summary);
    void managerDashboardGetVehiclesSignal(QList<ModelVehicle*>* summary);
    
    void managerDashboardGetDataSignalE(ModelDashboard* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void managerDashboardGetVehiclesSignalE(QList<ModelVehicle*>* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    
    void managerDashboardGetDataSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void managerDashboardGetVehiclesSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    
};

}
#endif
