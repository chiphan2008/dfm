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

#ifndef _SWG_SWGAdminDevicesApi_H_
#define _SWG_SWGAdminDevicesApi_H_

#include "SWGHttpRequest.h"

#include "ModelDevModel.h"
#include "ModelDevModelForm.h"
#include "ModelDevice.h"
#include "ModelDeviceForm.h"
#include "ModelFirmware.h"
#include "ModelFirmwareForm.h"

#include <QObject>

namespace api {

class SWGAdminDevicesApi: public QObject {
    Q_OBJECT

public:
    SWGAdminDevicesApi();
    SWGAdminDevicesApi(QString host, QString basePath);
    ~SWGAdminDevicesApi();

    QString host;
    QString basePath;
    QMap<QString, QString> defaultHeaders;

    void assignCompanyToDevice(qint64 device_id, qint64 company_id);
    void createDevModel(ModelDevModelForm body);
    void createDevice(ModelDeviceForm body);
    void createFirmware(qint64 model_id, ModelFirmwareForm body);
    void deleteAssignCompanyToDevice(qint64 device_id, qint64 company_id);
    void deleteDevModel(qint64 model_id);
    void deleteDevice(qint64 device_id);
    void deleteFirmware(qint64 model_id, qint64 firmware_id);
    void getDevModelById(qint64 model_id);
    void getDeviceById(qint64 device_id);
    void getFirmwareByIdAndModelId(qint64 model_id, qint64 firmware_id);
    void listDevModels();
    void listDevices(qint32 page, qint32 limit);
    void listFirmwares(qint64 model_id);
    void updateDevModel(ModelDevModelForm body);
    void updateDevice(ModelDeviceForm body);
    void updateFirmware(qint64 model_id, ModelFirmwareForm body);
    
private:
    void assignCompanyToDeviceCallback (HttpRequestWorker * worker);
    void createDevModelCallback (HttpRequestWorker * worker);
    void createDeviceCallback (HttpRequestWorker * worker);
    void createFirmwareCallback (HttpRequestWorker * worker);
    void deleteAssignCompanyToDeviceCallback (HttpRequestWorker * worker);
    void deleteDevModelCallback (HttpRequestWorker * worker);
    void deleteDeviceCallback (HttpRequestWorker * worker);
    void deleteFirmwareCallback (HttpRequestWorker * worker);
    void getDevModelByIdCallback (HttpRequestWorker * worker);
    void getDeviceByIdCallback (HttpRequestWorker * worker);
    void getFirmwareByIdAndModelIdCallback (HttpRequestWorker * worker);
    void listDevModelsCallback (HttpRequestWorker * worker);
    void listDevicesCallback (HttpRequestWorker * worker);
    void listFirmwaresCallback (HttpRequestWorker * worker);
    void updateDevModelCallback (HttpRequestWorker * worker);
    void updateDeviceCallback (HttpRequestWorker * worker);
    void updateFirmwareCallback (HttpRequestWorker * worker);
    
signals:
    void assignCompanyToDeviceSignal();
    void createDevModelSignal(ModelDevModel* summary);
    void createDeviceSignal(ModelDevice* summary);
    void createFirmwareSignal(ModelFirmware* summary);
    void deleteAssignCompanyToDeviceSignal();
    void deleteDevModelSignal();
    void deleteDeviceSignal();
    void deleteFirmwareSignal();
    void getDevModelByIdSignal(ModelDevModel* summary);
    void getDeviceByIdSignal(ModelDevice* summary);
    void getFirmwareByIdAndModelIdSignal(ModelFirmware* summary);
    void listDevModelsSignal(QList<ModelDevModel*>* summary);
    void listDevicesSignal(QList<ModelDevice*>* summary);
    void listFirmwaresSignal(QList<ModelFirmware*>* summary);
    void updateDevModelSignal(ModelDevModel* summary);
    void updateDeviceSignal(ModelDevice* summary);
    void updateFirmwareSignal(ModelFirmware* summary);
    
    void assignCompanyToDeviceSignalE(QNetworkReply::NetworkError error_type, QString& error_str);
    void createDevModelSignalE(ModelDevModel* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void createDeviceSignalE(ModelDevice* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void createFirmwareSignalE(ModelFirmware* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void deleteAssignCompanyToDeviceSignalE(QNetworkReply::NetworkError error_type, QString& error_str);
    void deleteDevModelSignalE(QNetworkReply::NetworkError error_type, QString& error_str);
    void deleteDeviceSignalE(QNetworkReply::NetworkError error_type, QString& error_str);
    void deleteFirmwareSignalE(QNetworkReply::NetworkError error_type, QString& error_str);
    void getDevModelByIdSignalE(ModelDevModel* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void getDeviceByIdSignalE(ModelDevice* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void getFirmwareByIdAndModelIdSignalE(ModelFirmware* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void listDevModelsSignalE(QList<ModelDevModel*>* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void listDevicesSignalE(QList<ModelDevice*>* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void listFirmwaresSignalE(QList<ModelFirmware*>* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void updateDevModelSignalE(ModelDevModel* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void updateDeviceSignalE(ModelDevice* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void updateFirmwareSignalE(ModelFirmware* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    
    void assignCompanyToDeviceSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void createDevModelSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void createDeviceSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void createFirmwareSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void deleteAssignCompanyToDeviceSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void deleteDevModelSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void deleteDeviceSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void deleteFirmwareSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void getDevModelByIdSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void getDeviceByIdSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void getFirmwareByIdAndModelIdSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void listDevModelsSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void listDevicesSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void listFirmwaresSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void updateDevModelSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void updateDeviceSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void updateFirmwareSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    
};

}
#endif
