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

#include "SWGManagerDashboardsApi.h"
#include "SWGHelpers.h"
#include "SWGModelFactory.h"

#include <QJsonArray>
#include <QJsonDocument>

namespace api {

SWGManagerDashboardsApi::SWGManagerDashboardsApi() {}

SWGManagerDashboardsApi::~SWGManagerDashboardsApi() {}

SWGManagerDashboardsApi::SWGManagerDashboardsApi(QString host, QString basePath) {
    this->host = host;
    this->basePath = basePath;
}

void
SWGManagerDashboardsApi::managerDashboardGetData() {
    QString fullPath;
    fullPath.append(this->host).append(this->basePath).append("/manager/dashboards");



    HttpRequestWorker *worker = new HttpRequestWorker();
    HttpRequestInput input(fullPath, "GET");





    foreach(QString key, this->defaultHeaders.keys()) {
        input.headers.insert(key, this->defaultHeaders.value(key));
    }

    connect(worker,
            &HttpRequestWorker::on_execution_finished,
            this,
            &SWGManagerDashboardsApi::managerDashboardGetDataCallback);

    worker->execute(&input);
}

void
SWGManagerDashboardsApi::managerDashboardGetDataCallback(HttpRequestWorker * worker) {
    QString msg;
    QString error_str = worker->error_str;
    QNetworkReply::NetworkError error_type = worker->error_type;

    if (worker->error_type == QNetworkReply::NoError) {
        msg = QString("Success! %1 bytes").arg(worker->response.length());
    }
    else {
        msg = "Error: " + worker->error_str;
    }


    QString json(worker->response);
    ModelDashboard* output = static_cast<ModelDashboard*>(create(json, QString("ModelDashboard")));
    worker->deleteLater();

    if (worker->error_type == QNetworkReply::NoError) {
        emit managerDashboardGetDataSignal(output);
    } else {
        emit managerDashboardGetDataSignalE(output, error_type, error_str);
        emit managerDashboardGetDataSignalEFull(worker, error_type, error_str);
    }
}

void
SWGManagerDashboardsApi::managerDashboardGetVehicles() {
    QString fullPath;
    fullPath.append(this->host).append(this->basePath).append("/manager/dashboards/vehicles");



    HttpRequestWorker *worker = new HttpRequestWorker();
    HttpRequestInput input(fullPath, "GET");





    foreach(QString key, this->defaultHeaders.keys()) {
        input.headers.insert(key, this->defaultHeaders.value(key));
    }

    connect(worker,
            &HttpRequestWorker::on_execution_finished,
            this,
            &SWGManagerDashboardsApi::managerDashboardGetVehiclesCallback);

    worker->execute(&input);
}

void
SWGManagerDashboardsApi::managerDashboardGetVehiclesCallback(HttpRequestWorker * worker) {
    QString msg;
    QString error_str = worker->error_str;
    QNetworkReply::NetworkError error_type = worker->error_type;

    if (worker->error_type == QNetworkReply::NoError) {
        msg = QString("Success! %1 bytes").arg(worker->response.length());
    }
    else {
        msg = "Error: " + worker->error_str;
    }

    QList<ModelVehicle*>* output = new QList<ModelVehicle*>();
    QString json(worker->response);
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonArray jsonArray = doc.array();

    foreach(QJsonValue obj, jsonArray) {
        ModelVehicle* o = new ModelVehicle();
        QJsonObject jv = obj.toObject();
        QJsonObject * ptr = (QJsonObject*)&jv;
        o->fromJsonObject(*ptr);
        output->append(o);
    }

    worker->deleteLater();

    if (worker->error_type == QNetworkReply::NoError) {
        emit managerDashboardGetVehiclesSignal(output);
    } else {
        emit managerDashboardGetVehiclesSignalE(output, error_type, error_str);
        emit managerDashboardGetVehiclesSignalEFull(worker, error_type, error_str);
    }
}


}